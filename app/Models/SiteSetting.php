<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    public function getLogoAttribute($siteLogo){
        if(isset($siteLogo)){
            return  \App\Lib\Image::url($siteLogo);
        }
        else{
            return  asset('backend/img/default.jpg');
        }
    }
}
