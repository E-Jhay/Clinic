<?php

namespace Database\Seeders;

use App\Models\BmiClassification;
use Illuminate\Database\Seeder;

class BmiClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BmiClassification::create(['name' => 'Underweight']);
        BmiClassification::create(['name' => 'Normal']);
        BmiClassification::create(['name' => 'Overweight']);
        BmiClassification::create(['name' => 'Obese']);
    }
}
