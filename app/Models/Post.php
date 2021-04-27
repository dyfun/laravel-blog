<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'detail',
        'category_id',
        'tags',
        'thumbnail'
    ];

    public function getCategory(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
