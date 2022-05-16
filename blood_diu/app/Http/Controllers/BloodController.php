<?php

namespace App\Http\Controllers;

use App\Models\AllImages;
use App\Models\blood_donate;
use App\Models\DonateRequest;
use App\Models\User;
use App\Notifications\UserBloodNeed;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class BloodController extends Controller
{
    public function history()
    {
        $histories = blood_donate::where('user_id', auth()->user()->id)->paginate();
        return inertia("Blood/Index", ['histories' => $histories]);
    }

    public function request()
    {
        $brequests = DonateRequest::with('relUser')
            ->where('status', 0)
            ->where('blood_needed_date', '>=', Carbon::today()->startOfDay()->toDateTimeString())
            ->whereNot('user_id', auth()->user()->id)
            ->latest()
            ->paginate();
        $myrequest = DonateRequest::where('user_id', auth()->user()->id)->paginate(7);
        return inertia("Blood/BloodRequest", ['brequests' => $brequests, 'myrequest' => $myrequest]);
    }

    public function requestPost(Request $req)
    {
        $req->validate([
            'want_blood' => 'required',
            'location' => 'required',
            'reason' => 'required',
            'blood_needed_date' => 'required',
        ]);
        DonateRequest::create([
            'user_id' => auth()->user()->id,
            'want_blood' => $req->want_blood,
            'location' => $req->location,
            'reason' => $req->reason,
            'blood_needed_date' => $req->date('blood_needed_date'),
            'description' => $req->description,
        ]);

        $users = User::whereNot('id', auth()->user()->id)
            ->where('blood_status', 1)
            ->where('blood_group', $req->want_blood)->get();
        //dd($users);
        Notification::send($users, new UserBloodNeed());
        return back()->with('success', 'Request Successfully Sent');
    }
    public function image(Request $req)
    {
        $req->validate([
            'gallery_image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);
        $imageName = time() . '.' . $req->file('gallery_image')->extension();
        $req->file('gallery_image')->move(public_path('images'), $imageName);
        auth()->user()->image()->create([
            'user_id' => auth()->id(),
            'image_link' => $imageName
        ]);
        return back()->with('success', 'Image Successfully Uploaded');
    }
    public function gallery(Request $req)
    {
        $data=AllImages::where('user_id',auth()->id())->get();
        return response($data);
    }
}
