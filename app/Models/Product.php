<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'title',
        'description',
        'price',
        'About',
        'discount',
        'rating',
        'ratings_number',
        'status', // ✅ لازم تكون موجودة هنا
    ];
    public function Category()
    {
        return $this->belongsTo(Category::class, 'category');
    }


    public function Images()
    {
        return $this->hasMany(ProductImage::class);
    }
}

