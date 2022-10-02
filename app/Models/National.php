<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class National extends Model
{
    use HasFactory;

    protected $fillable = [
        'rfc',
        'curp',
        'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
