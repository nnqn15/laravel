<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'image1',
        'image2',
        'image3',
        'price',
        'sale',
        'description',
        'status',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
