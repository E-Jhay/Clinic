<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'mobile_no',
        'age',
        'sex',
        'civil_status',
        'birthday',
        'address',
        'contact_person',
        'symptoms',
        'illness',
        'hospitalization',
        'allergies',
        'ps_history',
        'ob_history',
        'temperature',
        'pulse',
        'blood_pressure',
        'designation_id',
        'course_id',
    ];

    public function designation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function bmis()
    {
        return $this->hasMany(Bmi::class);
    }

}
