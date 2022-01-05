<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bmi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'height',
        'weight',
        'bmi',
        'bmi_classification_id',
    ];

    public function classification()
    {
        return $this->hasOne(BmiClassification::class, 'id', 'bmi_classification_id');
    }
}
