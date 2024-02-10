<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FIle extends Model
{
    use HasFactory;

    protected $table = 'files';
    protected $fillable = [
        'post_id',
        'fileName',
        'url'
    ];

    // dimiliki oleh 1 post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
