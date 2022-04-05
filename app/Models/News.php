<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'news';

    protected $fillable = [
        'title',
        'description',
        'category_id',
    
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function product(){
        return $this->belongsToMany(
            Product::class,
            'products_news',  //bang trung gian
            'new_id',    // khoa ngoai tuong ung voi model hien tai
            'product_id' // khoa ngoai cua bang con lai
        );
    }
}
