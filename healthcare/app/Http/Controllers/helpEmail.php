<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\contactAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\contact;
use Illuminate\Support\Facades\Hash;

class helpEmail extends Controller
{
    public function helpEmailIndex()
    {
        $email = contactAdmin::all();
        return view('admin.helpEmail', ['email' => $email]);
    }
    public function helpEmailShow($id)
    {
        $message = contactAdmin::find(decrypt($id));
        return view('admin.HelpMessage', ['message' => $message]);
    }
    public function helpEmailSend(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $contact = contactAdmin::findOrFail(decrypt($request->emailId));
        $contact->status = 1;
        $contact->save();

        Mail::to($request->email)->send(new contact($contact));
        
        session()->flash('msg', [
            'active' => 'success',
            'msg' => 'Message Sent'
        ]);
        return back();
    }
    public function helpEmailDelete($id)
    {
        $contact=contactAdmin::findOrFail($id);
        $contact->delete();
        session()->flash('msg', [
            'active' => 'error',
            'msg' => 'Message Deleted'
        ]);
        return back();
    }
}
