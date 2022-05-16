<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\doctorCategory;
use App\Models\question as ModelsQuestion;
use Illuminate\Http\Request;

class question extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category= doctorCategory::where('category_status', 0)->get();
        return view('admin.question',['category'=>$category]);
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
            'category_id'=>'required|numeric',
            'question_name'=>'required'
        ]);
        $catId=$request->category_id;
        $catCount=ModelsQuestion::where('category_id',$catId)->whereYear('created_at',date('Y'))->count();
        if($catCount>=10){
            session()->flash('msg', [
                'msg' => 'You Can Not Add More Than Ten Symptom',
                'active' => 'error'
            ]);
            return back();
        }
        ModelsQuestion::insert([
            'category_id'=>$request->category_id,
            'question_serial'=>++$catCount,
            'question_name'=>$request->question_name,
            'created_at'=>now()
        ]);
        session()->flash('msg', [
            'msg' => 'Symptom Added.',
            'active' => 'success'
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
