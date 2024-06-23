<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'place_of_birth',
        'date_of_birth',
        'father_name',
        'mother_name',
    ];

    public function stuntingCheck()
    {
        return $this->hasOne(StuntingCheck::class);
    }
}
