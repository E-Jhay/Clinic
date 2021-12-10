<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function healthProfile()
    {
        return $this->hasMany(HealthProfile::class);
    }
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
