<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mitigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'risk_id',
        'mitigation_description',
        'probability',
        'impact',
    ];

    public function risk()
    {
        return $this->belongsTo(\App\Models\Risk::class);
    }
}
