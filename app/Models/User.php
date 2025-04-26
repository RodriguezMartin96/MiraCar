<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
        'password' => 'hashed',
    ];
    
    /**
     * Check if the user is a taller.
     */
    public function isTaller()
    {
        return $this->role === 'taller';
    }
    
    /**
     * Check if the user is a normal user.
     */
    public function isUser()
    {
        return $this->role === 'user';
    }
    
    /**
     * Check if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Obtener los clientes asociados a este usuario.
     */
    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

    /**
     * Obtener los vehículos asociados a este usuario.
     */
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

    /**
     * Obtener los siniestros asociados a este usuario.
     */
    public function siniestros()
    {
        return $this->hasMany(Siniestro::class);
    }

    /**
     * Obtener los recambios asociados a este usuario.
     */
    public function recambios()
    {
        return $this->hasMany(Recambio::class);
    }

    /**
     * Obtener los documentos asociados a este usuario.
     */
    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    /**
     * Obtener los soportes asociados a este usuario.
     */
    public function soportes()
    {
        return $this->hasMany(Soporte::class);
    }
}