<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
    public function healthProfiles()
    {
        return $this->hasMany(HealthProfile::class);
    }
    public function releasedMedicines()
    {
        return $this->hasMany(ReleasedMedicine::class);
    }
}
