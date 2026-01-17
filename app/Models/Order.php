<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_number', 'customer_name', 'customer_email', 
        'customer_phone', 'address', 'total_price', 
        'status', 'snap_token'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}