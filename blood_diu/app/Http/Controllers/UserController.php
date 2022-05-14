<?php

namespace App\Http\Controllers;

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
            })->when($req->blood_group, function ($query) use ($req) {
                return $query->where('blood_group', $req->blood_group);
            })
            ->whereIn('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])
            ->get();
        return Inertia::render('Users/Index', [
            'users' => User::paginate()
        ]);
    }
}
