<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'like_count'
    ];

    //Post dimiliki 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 1 post mempunyai banyak komentar
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 1 post memiliki  banyak file
    public function files()
    {
        return $this->hasMany(File::class,  'post_id', 'id');
    }
}
