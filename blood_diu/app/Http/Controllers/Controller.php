<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //public function bloodShow(Request $request)
//{
//
//    $donor = Student::where('ID', $request->auth->ID);
//    if ($donor->exists()) {
//        $donate_info = $donor->first();
//        if ($donate_info) {
//            $last_donate_day = Carbon::now()->diffInDays(Carbon::parse($donate_info->last_donate));
//            if ((int)$last_donate_day >= 120) {
//                $donate_status = true;
//            } else {
//                $donate_status = false;
//            }
//        }
//    }
//
//    $student = Student::where('blood_status', 1)
//        //->withCount('relStudentBlood')
//        ->where('id', "!=", $request->auth->ID)
//        ->where(function ($query) {
//            $query->where("last_donate", "<=", Carbon::now()->subDays(120)->toDateTimeString())
//                ->orWhere('last_donate', Null);
//        })
//        ->when($request->input('b_group'), function ($query) use ($request) {
//            return $query->where('blood_group', $request->input("b_group"));
//        })
//        ->whereIn('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])
//        ->select("NAME", "PHONE_NO", "EMAIL", "BLOOD_GROUP", "CAMPUS_ID", "last_donate", "ID", "DEPARTMENT_ID", "BATCH_ID", "ROLL_NO")
//        ->with("relDepartment", "relBatch", 'relStudentBlood')
//        ->orderByDesc('last_donate')
//        ->paginate(30);
//    return response()->json(['donor_status' => $donate_status, 'donor' => $student]);
//}
//    public function bloodCreate(Request $request)
//    {
//        $date = date('m/d/Y');
//        $this->validate($request, [
//            'wantToDonate' => ['required', 'boolean'],
//            'last_donate' => ['boolean', 'nullable'],
//            'donate_date' => ['nullable', 'date', "before_or_equal:$date", 'required_if:last_donate,true'],
//        ], ['donate_date.required_if' => 'please fill donate date']);
//
//        try {
//            $student = Student::where('id', $request->auth->ID);
//            if ($request->wantToDonate) {
//                $student->update([
//                    "blood_status" => 1
//                ]);
//
//                if ($student->exists()) {
//                    $donate_info = $student->first();
//                    if ($donate_info) {
//                        $last_donate_day = Carbon::now()->diffInDays(Carbon::parse($donate_info->last_donate));
//                        if ((int)$last_donate_day <= 120) {
//                            return response(['donor_status' => ["You Can not Donate Before 3 month. Your Last Donate Was $last_donate_day day's Ago."]], 422);
//                        }
//                    }
//                }
//                if ($request->donateNow) {
//                    $student->update([
//                        "last_donate" => Carbon::now()->format('Y-m-d H:i:s')
//                    ]);
//
//                    BloodDonate::create([
//                        "students_id" => $request->auth->ID,
//                        "last_donate" => Carbon::now()->format('Y-m-d H:i:s')
//                    ]);
//                }
//                if ($request->last_donate) {
//                    $student->update([
//                        "last_donate" => Carbon::parse($request->donate_date)->format('Y-m-d H:i:s')
//                    ]);
//
//                    BloodDonate::create([
//                        "students_id" => $request->auth->ID,
//                        "last_donate" => Carbon::parse($request->donate_date)->format('Y-m-d H:i:s')
//                    ]);
//                }
//            } else {
//                $student->update([
//                    "blood_status" => 0
//                ]);
//            }
//            return response("success");
//        } catch (\Exception $e) {
//            return response("something wrong", 500);
//        }
//    }
}
//                if ($donor->exists()) {
//                    $donate_info = $donor->orderBy('last_donate', 'desc')->first();
//                    if ($donate_info) {
//                        $last_donate_day = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($donate_info->last_donate));
//                        if ((int)$last_donate_day <= 120) {
//                            return response(['donor_status' => ["You Can not Donate Before 3 month. Your Last Donate Was $last_donate_day's Ago."]], 422);
//                        }
//                    }
//                }
