<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public function getImageAttribute($banner){
        if(isset($banner)){
            return  \App\Lib\Image::url($banner);
        }
        else{
            return  asset('backend/img/default.jpg');
        }
    }
}
