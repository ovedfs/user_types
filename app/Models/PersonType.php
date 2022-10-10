<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document',
    ];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
