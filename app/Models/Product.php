<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // <--- TAMBAHKAN INI

class Product extends Model
{
    use HasFactory, SoftDeletes; // <--- TAMBAHKAN INI

    protected $fillable = [
        'name', 'description', 'price', 'image', 'category', 'is_featured', 'series'
    ];
}