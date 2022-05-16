<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\LoginUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        //checking activate or not
        $user = Auth::user();
        
        if ($user->status !== 1) {
            session()->flash('msg', [
                'active' => 'error', 'msg' => 'You are Disabled Please Contact To Admin',
            ]);
            Auth::logout();

            return redirect('/');
        }

        //checking activate or not

        //role based redirect
        event(new LoginUser($user));
        
        if ($user->role === "ADMIN") {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        } elseif ($user->role === "DOCTOR") {
            return redirect()->intended(RouteServiceProvider::DOCTOR);
        } elseif ($user->role === "PATIENT") {
            return redirect()->intended(RouteServiceProvider::PATIENT);
        }

        //role based redirect

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
