<?php

namespace App\Http\Controllers;

use App\Models\contactAdmin;
use App\Http\Controllers\Controller;
use App\Mail\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('help');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required',
        ]);
        $contact = contactAdmin::create([
            'full_name'=>$request->name,
            's_email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => now()
        ]);
        Mail::to('prantho@gamil.com')
        ->send(new contact($contact));

        if ($contact) {
            session()->flash('msg',[
                'active'=>'success',
                'msg'=>'Message Sent'
            ]);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\contactAdmin  $contactAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(contactAdmin $contactAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\contactAdmin  $contactAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(contactAdmin $contactAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\contactAdmin  $contactAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, contactAdmin $contactAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contactAdmin  $contactAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(contactAdmin $contactAdmin)
    {
        //
    }
}
