<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmiClassification extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function bmis()
    {
        return $this->hasMany(Bmi::class);
    }
}
