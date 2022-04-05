<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'thumbnail_url',
        'quantity',
        'status',
        'category_id',
        'price',
        
    ];
    // public function category(){
    //     return $this->belongTo(Product::class, 'category_id','id');
    // }
    public function categories(){
        return $this->belongsToMany(
            Category::class,
            'category_product',  //bang trung gian
            'product_id',    // khoa ngoai tuong ung voi model hien tai
            'category_id' // khoa ngoai cua bang con lai
        );
    }
}
