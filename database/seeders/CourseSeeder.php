<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create(['name' => 'AGRI']);
        Course::create(['name' => 'BEED']);
        Course::create(['name' => 'BSBA']);
        Course::create(['name' => 'BSE']);
        Course::create(['name' => 'BSHM']);
        Course::create(['name' => 'BSIT']);
        Course::create(['name' => 'N/A']);
    }
}
