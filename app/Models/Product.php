<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categorys(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function discounts(){
        return $this->belongsTo(DisCount::class,'discount_id','id');
    }
 
}
