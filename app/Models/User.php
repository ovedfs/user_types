<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'person_type_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function properties()
    {
        return $this->hasMany(Property::class, 'arrendador_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'arrendador_id');
    }

    public function hasProperty($id)
    {
        return $this->properties->contains($id);
    }

    public function isPropertyInContract($property_id)
    {
        return $this->contracts
            ->filter(fn($c) => $c->property->id == $property_id)
            ->count();
    }

    public function personType()
    {
        return $this->belongsTo(PersonType::class);
    }

    public function moral()
    {
        return $this->hasOne(Moral::class);
    }

    public function national()
    {
        return $this->hasOne(National::class);
    }

    public function foreign()
    {
        return $this->hasOne(Foreign::class);
    }

    public function setPersonTypeData($personTypeId, $request)
    {
        switch ($personTypeId) {
            case 1:
                $this->moral()->create(['rfc' => $request->rfc]);
                break;
            case 2:
                $this->national()->create([
                    'rfc' => $request->rfc,
                    'curp' => $request->curp
                ]);
                break;
            case 3:
                $this->foreign()->create([
                    'nue' => $request->nue,
                    'curp' => $request->curp
                ]);
                break;
            default:
                # code...
                break;
        }
    }
}
