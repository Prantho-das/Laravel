<?php

namespace Database\Seeders;

use App\Models\setting as ModelsSetting;
use Illuminate\Database\Seeder;

class setting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsSetting::updateOrCreate([
            'id' => 1
        ], [
            'title' => 'MediCare',
            'logo' => 'logo.svg',
            'email' => 'medicare@gmail.com',
            'contact' => ["01777777777", "01977777777"],
            'social' => ["https://www.facebook.com/medicarebangladesh2021", "https://www.google.com/medicarebangladesh2021"],
            'address' => 'Dhaka, Bangladesh',
        ]);
    }
}
