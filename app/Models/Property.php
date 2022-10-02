<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'title',
        'arrendador_id',
    ];
    
    public function arrendador()
    {
        return $this->belongsTo(User::class, 'arrendador_id');
    }
    
    public function contract()
    {
        return $this->hasOne(Contract::class);
    }
}
