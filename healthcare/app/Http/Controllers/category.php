<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\doctorCategory;
use Illuminate\Http\Request;

class category extends Controller
{
    protected $fileName;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = doctorCategory::all();
        return view('admin.admin_category', ['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_description' => 'required|min:3',
            'case_price' => 'required|numeric',
            'category_image' => 'required|mimes:png,jpg,jpeg|image|max:1024',
        ]);
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $ext = $image->getClientOriginalExtension();
            $fileName = "MEDICATOR" . time() . '.' . $ext;
            $image->storeAs('public/image', $fileName);
        }
        doctorCategory::create([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
            'case_price' => $request->case_price,
            'category_img' => $fileName,
        ]);
        session()->flash('msg', [
            'msg' => 'Category Inserted Successfully.',
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
        $category = doctorCategory::findOrFail(decrypt($id));
        return view('admin.admin_category_show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = doctorCategory::findOrFail(decrypt($id));
        return view('admin.admin_category_edit', ['category' => $category]);
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
            'category_name' => 'required',
            'category_description' => 'required|min:3',
            'case_price' => 'required|numeric',
            'category_image' => 'sometimes|mimes:png,jpg,jpeg|image|max:1024',
        ]);
        $category=doctorCategory::findOrFail(decrypt($id));
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $ext = $image->getClientOriginalExtension();
            $fileName = "MEDICATOR" . time() . '.' . $ext;
            $image->storeAs('public/image', $fileName);
            $category->update([
                'category_name' => $request->category_name,
                'case_price' => $request->case_price,
                'category_description' => $request->category_description,
                'category_img' => $fileName,
            ]);
        } else {
            $category->update([
                'category_name' => $request->category_name,
                'case_price' => $request->case_price,
                'category_description' => $request->category_description,
            ]);
        }
        session()->flash('msg', [
            'msg' => 'Category Updated Successfully!',
            'active' => 'info'
        ]);
        return redirect()->to('admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = doctorCategory::findOrFail(decrypt($id));
        if ($category->category_status === 1) {
            $category->category_status = 0;
        } elseif ($category->category_status === 0) {
            $category->category_status = 1;
        }
        $category->save();
        session()->flash('msg', [
            'msg' => 'Category Disabled!',
            'active' => 'error'
        ]);
        return back();
    }
}
