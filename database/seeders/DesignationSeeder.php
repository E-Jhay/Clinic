<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Designation::create(['name' => 'Student']);
        Designation::create(['name' => 'Faculty']);
        Designation::create(['name' => 'Staff']);
    }
}
