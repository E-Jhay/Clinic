<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_no');
            $table->string('age');
            $table->string('sex');
            $table->string('civil_status');
            $table->string('birthday');
            $table->string('address');
            $table->string('contact_person');
            $table->string('symptoms')->nullable();
            $table->string('illness')->nullable();
            $table->string('hospitalization')->nullable();
            $table->string('allergies')->nullable();
            $table->string('ps_history')->nullable();
            $table->string('ob_history')->nullable();
            $table->string('temperature')->nullable();
            $table->string('pulse')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->foreignId('designation_id')->constrained();
            $table->foreignId('course_id')->constrained()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_profiles');
    }
}
