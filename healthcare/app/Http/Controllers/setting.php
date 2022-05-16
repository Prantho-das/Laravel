<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\setting as ModelSetting;

class setting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'title' => "required",
            'logo' => "sometimes",
            'email' => "required",
            'contact' => "required",
            'social' => "required",
            'address' => "required",
            'reassignDay' => "required",
        ]);
        if($request->file('logo')){
            $imgName = 'MEDI_CASE' . uniqid() . time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path() . '/storage/image/', $imgName);
        }else{
            $imgName='logo.svg';
        }
        $social=$request->social;
        $filterSocial= array_filter($social, fn ($value) => !is_null($value) && $value !== '');
        $filterSocial;
        Modelsetting::updateOrCreate(['id' => $id], [
            'title' => $request->title,
            'logo' => $imgName,
            'email' => $request->email,
            'contact' => $request->contact,
            'social' => $filterSocial,
            'address' => $request->address,
            'covidNews' => $request->covidNews=='on'?'on':'off',
            'reassignDay'=>$request->reassignDay,
            'updated_at'=>now()
        ]);
        session()->flash('msg', [
            'active' => 'success', 'msg' => 'Setting Updated',
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
        //
    }
}
