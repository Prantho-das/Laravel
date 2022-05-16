<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\userRegisterMail;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'f_name' => 'required|string|max:50',
            'l_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|digits_between:11,11|numeric',
            'NID' => 'required|string|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'u_id' => uniqid($request->f_name, false),
            'NID' => $request->NID,
            'password' => Hash::make($request->password),
        ]);
        // Auth::login($user = User::create([
        //     'f_name' => $request->f_name,
        //     'l_name' => $request->l_name,
        //     'email' => $request->email,
        //     'NID' => $request->NID,
        //     'password' => Hash::make($request->password),
        // ]));


        event(new Registered($user));

        session()->flash('msg', [
            'msg' => 'You are Registered.Please Login In',
            'active' => "success",
        ]);
        $user->notify(new userRegisterMail);

        return redirect(RouteServiceProvider::HOME);
    }
}
