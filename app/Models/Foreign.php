<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foreign extends Model
{
    use HasFactory;

    protected $fillable = [
        'rfc',
        'nue',
        'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
