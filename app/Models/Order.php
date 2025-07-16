<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status'];

    // ✅ علاقة الطلب بالعناصر (المنتجات داخل الطلب)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
