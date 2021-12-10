<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'course',
        'complaints',
        'diagnosis',
        'medicines_given',
        'medical_service',
        'designation_id',
    ];

    public function designation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }
}
