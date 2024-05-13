<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function colorSizes()
    {
        return $this->hasMany(ProductColorSize::class, 'id', 'product_id');
    }
}
