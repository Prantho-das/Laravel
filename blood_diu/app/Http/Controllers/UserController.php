<?php

namespace App\Http\Controllers;

use App\Models\blood_donate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $req)
    {
        $user = User::with('relBlood')
            ->withCount('relBlood')
            ->where('blood_status', 1)
            ->where(function ($query) {
                $query->where('last_donate', '<=', Carbon::now()->subMonth(3)->toDateTimeString())
                    ->orWhere('last_donate', null);
            })
            ->whereNot('id', auth()->id())
            ->when($req->blood_group, function ($query) use ($req) {
                return $query->where('blood_group', $req->blood_group);
            })
            ->whereIn('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])
            ->paginate();
        return Inertia::render('Users/Index', [
            'users' => $user,
        ]);
    }

    public function blood_status()
    {
        request()->validate([
            'wantToDonate' => 'required|boolean',
            'lastDonate' => 'required_if:wantToDonate,true|boolean',
            'lastDonateDate' => 'required_if:lastDonate,true|date',
        ]);
        $user=auth()->user();
        if (request()->wantToDonate) {
            $user->blood_status = 1;
            $user->last_donate= request()->lastDonateDate ?? null;
            $user->save();
            if (request()->lastDonateDate) {
                if (auth()->user()->last_donate) {
                    if (Carbon::parse(auth()->user()->last_donate)->diffInMonths(Carbon::now()) > 3) {
                        blood_donate::create([
                            'user_id' => auth()->id(),
                            'last_donate' => request()->lastDonateDate,
                            'address' => request()->address,
                            'reason' => request()->reason,
                        ]);
                    }
                }else{
                    blood_donate::create([
                        'user_id' => auth()->id(),
                        'last_donate' => request()->lastDonateDate,
                        'address' => request()->address,
                        'reason' => request()->reason,
                    ]);
                }
            }
        } else {
           $user->blood_status = 0;
           $user->save();
        }
        return back()->with('success', 'Blood Status Updated');
    }
}
