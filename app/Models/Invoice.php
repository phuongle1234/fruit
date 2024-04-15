<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
         'user_id', 'product_id', 'customer_name', 'amount', 'quantity', 'code'
    ];

    public function prodcuts()
    {
       return $this->hasOne(Product::class, 'id', 'product_id')->withTrashed();
    }

    public function categories()
    {
       return $this->hasOneThrough(Category::class, Product::class, 'id', 'id', 'product_id', 'category_id' )->withTrashed();
    }

}
