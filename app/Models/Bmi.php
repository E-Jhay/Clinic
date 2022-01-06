<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bmi extends Model
{
    use HasFactory;

    protected $fillable = [
        'health_profile_id',
        'height',
        'weight',
        'bmi',
        'bmi_classification_id',
    ];

    public function health_profile()
    {
        return $this->hasOne(HealthProfile::class, 'id', 'health_profile_id');
    }
    public function classification()
    {
        return $this->hasOne(BmiClassification::class, 'id', 'bmi_classification_id');
    }
}
