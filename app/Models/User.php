<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'lastname',
        'dni',
        'email',
        'phone',
        'avatar',
        'role',
        'company_name',
        'company_nif',
        'logo',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function isTaller()
    {
        return $this->role === 'taller';
    }
    
    public function isUser()
    {
        return $this->role === 'user';
    }
    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

    public function siniestros()
    {
        return $this->hasMany(Siniestro::class);
    }

    public function recambios()
    {
        return $this->hasMany(Recambio::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function soportes()
    {
        return $this->hasMany(Soporte::class);
    }
}