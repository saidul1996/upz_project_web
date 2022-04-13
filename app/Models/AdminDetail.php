<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDetail extends Model
{
    use HasFactory;

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
