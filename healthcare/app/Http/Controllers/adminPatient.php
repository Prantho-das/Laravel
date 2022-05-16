<?php

namespace App\Http\Controllers;

use App\Events\CaseAssign;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\fileExists;

class adminPatient extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = User::with('patientCaseNumber')->where('role', 'PATIENT')->get();
        return view('admin.admin_patients', ['patient' => $patient]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'f_name' => 'required|string|max:50',
            'l_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'NID' => 'required|string|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'u_id' => uniqid($request->f_name, false),
            'NID' => $request->NID,
            'password' => Hash::make($request->password),
        ]);
        session()->flash(
            'msg',
            [
                'active' => 'success',
                'msg' => 'Patient Added.Please Login In'
            ]
        );
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pInfo=User::findOrFail(decrypt($id));
        return view("admin.admin_patient_edit",compact('pInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'f_name' => 'required|min:3|max:10',
            'l_name' => 'required|min:3|max:10',
            'phone' => 'required|digits_between:11,11|numeric',
            'email' => "required|unique:users,email,$id",
            'nid' => 'required',
            'avatar' => 'nullable|mimes:jpg,png',
        ]);
        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            $avatar_name = 'Medi' . time() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->storeas('public/image', $avatar_name);
            if ($user->avatar !== null) {
                if (fileExists(public_path() . '/storage/image/' . $user->avatar)) {
                    unlink(public_path() . '/storage/image/' . $user->avatar);
                }
            }
        } else {
            $avatar_name = $user->avatar;
        }
        $user->update([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'NID' => $request->nid,
            'phone' => $request->phone,
            'avatar' => $avatar_name,
        ]);

        session()->flash('msg', [
            'msg' => "Patient Information Updated",
            'active' => "success",
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findOrFail(decrypt($id));
        $user->status = ($user->status == 0 ? 1 : 0);
        $user->save();
        session()->flash('msg', [
            'msg' => "Patient " . ($user->status === 0 ? "Disabled" : "Enabled"),
            'active' => ($user->status === 0 ? "error" : "success")
        ]);
        return back();
    }
}
