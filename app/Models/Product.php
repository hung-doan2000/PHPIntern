<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'detail',
        'brand',
        'price',
        'category_id',
        'image',
    ];
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
