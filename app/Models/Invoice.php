<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'name',
        'email',
        'phone',
        'Address',
        'phone',
    ];
    public function orderitems() {
        return $this->hasMany(OrderItem::class);
    }
    public function product() {
        return $this->belongsToMany(Product::class,'order_items');
    }
  
  
}
