<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'user_id', 'price', 'description', 'img_url', 'category_id', 'condition_id'
    ];

    // Usersテーブルとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
    public function comments()
    {
        return $this->belongsToMany(User::class, 'comments')->withPivot('comment');
    }
    public function soldItems()
    {
        return $this->belongsToMany(User::class, 'sold_item');
    }
    // categoriesテーブルとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function categoryItem()
    {
        return $this->belongsToMany(Category::class);
    }
    // Conditionsテーブルとのリレーション
    public function condition()
    {
        return $this->belongsTo(Condition::class, 'condition_id');
    }
    // それぞれの件数のメソッド
    public function commentsCount()
    {
        return $this->comments()->count();
    }
    public function likesCount()
    {
        return $this->likes()->count();
    }
    public function soldItemsCount()
    {
        return $this->soldItems()->count();
    }
}
