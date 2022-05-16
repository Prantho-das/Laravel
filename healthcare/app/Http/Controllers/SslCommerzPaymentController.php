<?php

namespace App\Http\Controllers;

use App\Events\CaseAssign;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Mail\invoice;
use App\Models\Caselist;
use App\Models\doctorCategory;
use App\Models\order;
use App\Models\payment;
use App\Models\User;
use App\Notifications\allNotification;
use App\Providers\CaseAssignListener;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SslCommerzPaymentController extends Controller
{
    public $tran_id;
    public $caseInCheck;
    public $caseAmount;

    public function case_payment_patient()
    {
        $user = Auth::user();
        $case = Caselist::where('payment_status', 0)->with('categoryInfo', 'paymentInfo')
            ->where('patient_id', $user->id)
            ->get();
        $pcase = Caselist::where('payment_status', 1)->with('categoryInfo', 'paymentInfo')
            ->where('patient_id', $user->id)
            ->get();

        return view('patients.payment', ['case' => $case, 'pcase' => $pcase]);
    }
    public function case_payment_admin()
    {
        $orders = order::where('status', 'Processing')->get();
        return view('admin.admin_payment', compact('orders'));
    }
    public function case_payment_admin_invoice($case)
    {
        $payment = payment::where('transaction_id', $case)->with('caseAssign')->firstOrFail();
        return view('admin.invoice', compact('payment'));
    }
    public function case_payment_doctor()
    {
        return view('doctor.doctor_payment');
    }
    public function exampleHostedCheckout($case)
    {
        $case = Caselist::with("categoryInfo")->findOrFail(decrypt($case));
        return view('patients.exampleHosted', compact('case'));
    }
    public function index(Request $request)
    {
        $request->validate([
            'cus_mobile' => 'required',
            'cus_case_id' => 'required',
            'cus_addr' => 'required'
        ]);
        $auth = Auth::user();
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        $caseData = Caselist::findOrFail(decrypt($request->cus_case_id));
        $post_data = array();
        $post_data['total_amount'] = $request->cus_price; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $auth->f_name;
        $post_data['cus_email'] = $auth->email;
        $post_data['cus_add1'] = $request->cus_addr ? $request->cus_addr : $auth->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->cus_mobile ? $request->cus_mobile : $auth->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Health";
        $post_data['product_category'] = "Information";
        $post_data['product_profile'] = "Health-Information";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'case_id' => $caseData->id,
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'created_at' => now()
            ]);

        $update_product_payment = DB::table('payments')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'case_id' => $caseData->id,
                'patient_id' => $caseData->patient_id,
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'due_amount' => (int)(($caseData->categoryInfo->case_price) - ($request->cus_price)),
                'installment_date' => now(),
                'installment' => 1,
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'created_at' => now()
            ]);
        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }
    public function payViaAjax(Request $request)
    {
        $auth = Auth::user();
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        $reqData = (array) json_decode($request->cart_json);
        $caseData = Caselist::findOrFail(decrypt($reqData['cus_case_id']));
        $post_data = array();
        $post_data['total_amount'] = $reqData['cus_price']; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $auth->f_name;
        $post_data['cus_email'] = $auth->email;
        $post_data['cus_add1'] = $reqData['cus_addr'] ? $reqData['cus_addr'] : $auth->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $reqData['cus_mobile'] ? $reqData['cus_mobile'] : $auth->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Health";
        $post_data['product_category'] = "Information";
        $post_data['product_profile'] = "Health-Information";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        $this->caseInCheck = DB::table('payments')->where('case_id', decrypt($reqData['cus_case_id']))->where('status', 'Processing')->where("installment", 1)->first();

        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'case_id' => $caseData->id,
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'created_at' => now()
            ]);

        if ($this->caseInCheck) {
            $this->tran_id = $this->caseInCheck->transaction_id;
            $this->caseAmount = $caseData->case_price;
        } else {
            $update_product_payment = DB::table('payments')
                ->where('transaction_id', $post_data['tran_id'])
                ->updateOrInsert([
                    'case_id' => $caseData->id,
                    'patient_id' => $caseData->patient_id,
                    'name' => $post_data['cus_name'],
                    'email' => $post_data['cus_email'],
                    'phone' => $post_data['cus_phone'],
                    'amount' => $post_data['total_amount'],
                    'status' => 'Pending',
                    'address' => $post_data['cus_add1'],
                    'transaction_id' => $post_data['tran_id'],
                    'currency' => $post_data['currency'],
                    'created_at' => now()
                ]);
        }


        #Before  going to initiate the payment order status need to update as Pending.


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $cardname = $request->input('card_type');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('case_id', 'transaction_id', 'status', 'currency', 'amount')->first();
        if ($order_detials->status == 'Pending') {

            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */

                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing', 'paymode' => $cardname, 'updated_at' => now()]);

                $this->caseInCheck = DB::table('payments')->where('case_id', $order_detials->case_id)->where('status', 'Processing')->where("installment", 1)->first();
                $caseDetails = Caselist::with('categoryInfo')->where('id', $order_detials->case_id)->first();
                if ($this->caseInCheck) {
                    $update_product = DB::table('payments')
                        ->where('transaction_id', $this->caseInCheck->transaction_id)
                        ->update([
                            'status' => 'Processing',
                            'cardname' => $cardname,
                            'amount' => $caseDetails->categoryInfo->case_price,
                            'installment' => 0,
                            'due_amount' => 0,
                            'clear_date' => now(),
                            'updated_at' => now()
                        ]);
                } else {

                    $update_product = DB::table('payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing', 'cardname' => $cardname, 'updated_at' => now()]);
                }

                $case_id = $order_detials->case_id;
                $caseDet = Caselist::findOrFail($case_id);
                $caseDet->update([
                    'payment_status' => 1
                ]);

                $admin = User::where('role', 'ADMIN')->get();

                Notification::send($admin, new allNotification("Payment Done", "admin/payment"));
                event(new CaseAssign());
                session()->flash('msg', [
                    'msg' => "Payment Done",
                    'active' => "success",
                ]);

                Mail::to(Auth::user()->email)->send(new invoice($case_id));

                // if ($this->caseInCheck) {
                //     Mail::to(Auth::user()->email)->send(new invoice($this->caseInCheck->transaction_id));
                // } else {
                //     Mail::to(Auth::user()->email)->send(new invoice($tran_id));
                // }
                return redirect('patient/case');
                // echo "<br >Transaction is successfully Completed";
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }
    }


    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing', 'updated_at' => now()]);
                    echo "Transaction is successfully Completed";

                    Mail::to(Auth::user()->email)->send(new invoice($tran_id));
                    return redirect('payment/case');
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
