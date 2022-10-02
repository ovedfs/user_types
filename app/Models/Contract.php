<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'arrendador_id',
        'arrendatario_id',
        'obligado_id',
        'fiador_id',
        'property_id',
    ];
    
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    
    public function arrendador()
    {
        return $this->belongsTo(User::class, 'arrendador_id');
    }
    
    public function arrendatario()
    {
        return $this->belongsTo(User::class, 'arrendatario_id');
    }
    
    public function obligado()
    {
        return $this->belongsTo(User::class, 'obligado_id');
    }
    
    public function fiador()
    {
        return $this->belongsTo(User::class, 'fiador_id');
    }
}
