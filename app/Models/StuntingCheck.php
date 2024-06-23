<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuntingCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'height',
        'weight',
        'is_poor_family',
        'stunting_status',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
