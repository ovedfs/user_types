<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moral extends Model
{
    use HasFactory;

    protected $fillable = [
        'rfc',
        'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
