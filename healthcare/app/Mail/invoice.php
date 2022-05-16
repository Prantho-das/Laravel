<?php

namespace App\Mail;

use App\Models\Caselist;
use App\Models\payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class invoice extends Mailable
{
    use Queueable, SerializesModels;
    protected $tran_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tran_id)
    {
        $this->tran_id = $tran_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$payment = payment::where('transaction_id', $this->tran_id)->with('caseAssign')->first();
        $payment = Caselist::with(['paymentInfo' => function ($query) {
            $query->latest();
        }])->with('categoryInfo')
            ->first();
        return $this->view('emails.invoice', compact('payment'));
    }
}
