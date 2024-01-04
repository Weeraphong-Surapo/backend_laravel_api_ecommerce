<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisCount extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class,'discount_id','id');
    }
}
