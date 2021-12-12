<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleasedMedicine extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'designation_id', 'medicine_name'];

    public function designation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }
    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
