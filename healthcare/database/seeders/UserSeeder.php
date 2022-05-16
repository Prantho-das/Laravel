<?php

namespace Database\Seeders;

use App\Http\Controllers\category;
use App\Models\doctorCategory;
use App\Models\doctorCategoryAssign;
use App\Models\doctorStatus;
use App\Models\Loginfo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patientId = User::insertGetId([
            'f_name' => "PATIENT",
            'l_name' => "PATIENT",
            'email' => "patient@gmail.com",
            'phone' => "01777777777",
            'address' => 'Dhaka, Bangladesh',
            'u_id' => uniqid('PATIENT', false),
            'role' => 'PATIENT',
            'NID' => "12345678903",
            'password' => Hash::make("12345678910"),
            'created_at' => now()
        ]);
        $doctorId = User::insertGetId([
            'f_name' => "DOCTOR",
            'l_name' => "DOCTOR",
            'email' => "doctor@gmail.com",
            'phone' => "01777777777",
            'address' => 'Dhaka, Bangladesh',
            'u_id' => uniqid('DOCTOR', false),
            'role' => 'DOCTOR',
            'NID' => "12345678903",
            'password' => Hash::make("12345678910"),
            'created_at' => now()
        ]);
        $categoryId = doctorCategory::insertGetId([
            'category_name' => "N/A",
            'category_description' => "N/A",
            'category_img' => 'https://s.gravatar.com/avatar/',
            'case_price' => 20
        ]);
        doctorCategoryAssign::create([
            'user_id' => $doctorId,
            'category_id' => $categoryId
        ]);
        $adminId = User::insertGetId([
            'f_name' => "SUPER",
            'l_name' => "ADMIN",
            'email' => "admin@gmail.com",
            'phone' => "01777777777",
            'address' => 'Dhaka, Bangladesh',
            'u_id' => uniqid('SUPER', false),
            'role' => 'ADMIN',
            'NID' => "12345678903",
            'password' => Hash::make("12345678910"),
            'created_at' => now()
        ]);
        doctorStatus::create([
            'doctor_id' => $doctorId,
            'doctor_status' => 0,
            'created_at' => now()
        ]);
        Loginfo::create([
            'user_id' => $doctorId,
            'created_at' => now()
        ]);
        Loginfo::create([
            'user_id' => $adminId,
            'created_at' => now()
        ]);
        Loginfo::create([
            'user_id' => $patientId,
            'created_at' => now()
        ]);
    }
}
