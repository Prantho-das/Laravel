<?php

namespace App\Http\Controllers;

use App\Events\CaseAssign;
use App\Http\Controllers\Controller;
use App\Models\doctorCategory;
use App\Models\doctorCategoryAssign;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\FileExists;

use function PHPUnit\Framework\fileExists;

class doctorCategoryController extends Controller
{
    public function editShow($id)
    {
        $dInfo = User::findOrFail(decrypt($id));
        $aCategory = doctorCategory::where('category_status', 0)->get();
        $dCategory = doctorCategoryAssign::where('user_id', decrypt($id))->get();
        return view(
            'admin.admin_doctors_edit',
            [
                'dInfo' => $dInfo,
                'aCategory' => $aCategory,
                'dCategory' => $dCategory
            ]
        );
    }
    public function edit(Request $req)
    {
        $id = decrypt($req->user_id);
        $req->validate([
            'f_name' => 'required|min:3|max:25',
            'l_name' => 'required|min:3|max:25',
            'phone' => 'required|digits_between:11,11|numeric',
            'email' => "required|unique:users,email,$id",
            'nid' => 'required',
            'avatar' => 'nullable|mimes:jpg,png',
            'category' => 'required'
        ]);
        $user = User::findOrFail($id);

        if ($req->hasFile('avatar')) {
            $avatar_name = 'Medi' . time() . '.' . $req->file('avatar')->getClientOriginalExtension();
            $req->file('avatar')->storeas('public/image', $avatar_name);
            if ($user->avatar !== null) {
                if (fileExists(public_path() . '/storage/image/' . $user->avatar)) {
                    unlink(public_path() . '/storage/image/' . $user->avatar);
                }
            }
        } else {
            $avatar_name = $user->avatar;
        }
        $user->update([
            'f_name' => $req->f_name,
            'l_name' => $req->l_name,
            'NID' => $req->nid,
            'phone' => $req->phone,
            'avatar' => $avatar_name,
        ]);
        if ($this->doctor_category_assign_edit($id, $req->input('category'))) {
            event(new CaseAssign());
            session()->flash('msg', [
                'msg' => "Doctor Information Updated",
                'active' => "success",
            ]);
            return back();
        } else {
            return abort(404);
        }
    }
    protected function doctor_category_assign_edit($id, $categorySelect)
    {
        $category = doctorCategoryAssign::where('user_id', $id);
        $category->delete();

        try {
            foreach ($categorySelect as $value) {
                doctorCategoryAssign::create([
                    'user_id' => $id,
                    'category_id' => $value,
                    'created_at' => now()
                ]);
            }
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }
}
