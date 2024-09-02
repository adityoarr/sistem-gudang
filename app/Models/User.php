<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';
    protected $fillable = ['email', 'password', 'nama', 'alamat', 'telp', 'jenisKelamin'];
    protected $hidden = [
        'password'
    ];

    public function mutasi(): HasMany
    {
        return $this->hasMany(Mutasi::class, 'idUser', 'id');
    }
}
