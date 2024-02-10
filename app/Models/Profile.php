<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $fillable = [
        'user_id',
        'jenis_kelamin',
        'tanggal_lahir',
        'negara',
        'biografi',
        'url',
    ];

    // dimiliki oleh hanya 1 user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
