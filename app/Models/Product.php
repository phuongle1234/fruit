<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{

    protected $fillable = [
        'name', 'category_id', 'unit', 'price'
    ];

    public function categories()
    {
       return $this->belongsTo(Category::class, "category_id", "id");
    }
}
