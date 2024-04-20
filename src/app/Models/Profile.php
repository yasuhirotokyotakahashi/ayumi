<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['nickname', 'user_id', 'img_url', 'postcode', 'address', 'building'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
