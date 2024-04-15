<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'category_id', 'unit', 'price'
    ];

    public function categories()
    {
       return $this->belongsTo(Category::class, "category_id", "id")->withTrashed();
    }
}
