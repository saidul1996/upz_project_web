<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function requisitionProducts(){
        return $this->hasMany(RequisitionProduct::class);
    }

    public function getImageAttribute($product){
        if(isset($product)){
            return  \App\Lib\Image::url($product);
        }
        else{
            return  asset('backend/img/default.jpg');
        }
    }
}
