<?php

namespace App\Http\Livewire;

use App\Events\CaseAssign;
use App\Models\doctorCategory;
use App\Models\doctorCategoryAssign;
use App\Models\doctorStatus;
use App\Models\Loginfo;
use App\Models\specilization_of_doctor;
use App\Models\User;
use App\Notifications\userRegisterMail;

use function PHPUnit\Framework\fileExists;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminDoctor extends Component
{
    use WithFileUploads;

    protected $status;
    protected $message;

    //* from fields
    public $f_name;
    public $l_name;
    public $phone;
    public $email;
    public $nid;
    public $categoryId = [];
    public $specialization;
    public $password;
    public $password_confirmation;
    public $avatar;
    //* from fields
    protected $avatar_name;

    public $user_id;
    public $avatar_img;
    protected $listeners = ['admin_doctor_modal_show', 'admin_doctor_modal_close', 'refresh' => '$refresh'];

    public function admin_doctor_modal_close()
    {
        $this->reset();
        $this->emitSelf('refresh');
    }

    public function admin_doctor_modal_show(User $user)
    {
        $this->f_name = $user->f_name;
        $this->l_name = $user->l_name;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->nid = $user->NID;
        $this->avatar_img = $user->avatar;
        $this->user_id = $user->id;
        $this->categoryId = doctorCategoryAssign::where('user_id', $user->id)->pluck('category_id');
        $this->specialization = specilization_of_doctor::where('doctor_id', $user->id)->first();
    }
    public function store()
    {
        $this->validate([
            'f_name' => 'required|min:3|max:25',
            'l_name' => 'required|min:3|max:25',
            'phone' => 'required|digits_between:11,11|numeric',
            'email' => 'required|email|unique:users',
            'nid' => 'required|unique:users,NID',
            'password' => 'required|min:8|confirmed',
            'avatar' => 'nullable|mimes:jpg,png',
            'categoryId' => 'required',
        ]);
        if ($this->avatar) {
            $this->avatar_name = 'Medi' . time() . '.' . $this->avatar->getClientOriginalExtension();
            $this->avatar->storeAs('image', $this->avatar_name, 'public');
        }
        $userid = User::insertGetId([
            'f_name' => $this->f_name,
            'l_name' => $this->l_name,
            'NID' => $this->nid,
            'u_id' => uniqid($this->f_name, false),
            'phone' => $this->phone,
            'email' => $this->email,
            'role' => "DOCTOR",
            'password' => Hash::make($this->password),
            'avatar' => $this->avatar_name,
            'created_at' => now()
        ]);
        $this->doctor_status_loginfo($userid);

        if ($this->doctor_category_assign($userid)) {
            $this->reset();
        } else {
            return abort(404);
        }
        event(new CaseAssign());
        $this->dispatchBrowserEvent('admin_doctor_modal');
        session()->flash('msg', [
            'msg' => "Doctor Added",
            'active' => "success",
        ]);
        User::findOrFail($userid)->notify(new userRegisterMail);
    }

    public function status($id)
    {
        $user = User::find($id);
        if ($user->status === 1) {
            $this->status = 0;
            $this->message = "Doctor Disabled";
        } elseif ($user->status === 0) {
            $this->status = 1;
            $this->message = "Doctor Enabled";
        }
        $user->status = $this->status;
        $user->save();
        $this->emitSelf('refresh');
        event(new CaseAssign());
        session()->flash('msg', [
            'msg' => $this->message,
            'active' => "info",
        ]);
    }
    public function delete($id)
    {
        $user = User::find($id);
        if ($user->avatar !== null) {
            if (fileExists(public_path() . '/storage/image/' . $user->avatar)) {
                unlink(public_path() . '/storage/image/' . $user->avatar);
            }
        }
        $user->delete();
        session()->flash('msg', [
            'msg' => "Doctor Removed",
            'active' => "error",
        ]);
    }
    public function render()
    {
        $doctor = User::with(['userlog' => function ($query) {
            $query->latest();
        }])->with(['doctorCase' => function ($query) {
            $query->where('case_status', 1)->get();
        }])->where('role', 'DOCTOR')->get();

        $category = doctorCategory::where('category_status',0)->get();
        return view('livewire.admin-doctor', ['doctor' => $doctor, 'category' => $category]);
    }
    protected function doctor_category_assign($id)
    {
        try {
            foreach ($this->categoryId as $value) {
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

    protected function doctor_status_loginfo($id)
    {
        Loginfo::create([
            'user_id' => $id,
            'created_at' => now()
        ]);
        doctorStatus::create([
            'doctor_id' => $id,
            'doctor_status' => 0,
            'created_at' => now()
        ]);
    }
}
// protected function doctor_specialization_edit()
// {
//     $doctorSpEdit = specilization_of_doctor::where('doctor_id', $this->user_id)->update([
//         'doctor_id' => $this->user_id,
//         'highest_degree_one' => $this->highest_degree_one,
//         'highest_degree_two' => $this->highest_degree_two,
//         'highest_degree_three' => $this->highest_degree_three,
//         'highest_degree_four' => $this->highest_degree_four,
//         'specilization' => $this->Specialization,
//     ]);
//     if (!$doctorSpEdit) {
//         return false;
//     }
//     return true;
// }

    // $doctorSpEdit = specilization_of_doctor::where('doctor_id', $this->user_id)->update([
        //     'doctor_id' => $this->user_id,
        //     'highest_degree_one' => $this->highest_degree_one,
        //     'highest_degree_two' => $this->highest_degree_two,
//     'highest_degree_three' => $this->highest_degree_three,
//     'highest_degree_four' => $this->highest_degree_four,
//     'specilization' => $this->Specialization,
// ]);
// $doctorSp = specilization_of_doctor::create([
//     'doctor_id' => $id,
//     'highest_degree_one' => $this->highest_degree_one,
//     'highest_degree_two' => $this->highest_degree_two,
//     'highest_degree_three' => $this->highest_degree_three,
//     'highest_degree_four' => $this->highest_degree_four,
//     'specilization' => $this->Specialization,
// ]);
