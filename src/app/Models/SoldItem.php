<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldItem extends Model
{
    use HasFactory;
    protected $table = 'sold_items';
    protected $fillable = ['user_id', 'item_id'];
}
