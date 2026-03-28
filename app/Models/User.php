<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    public $incrementing = false; // UUID
    protected $keyType = 'string';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password_hash',
        'role'
    ];

    protected $hidden = [
        'password_hash',
    ];

    // 🔥 TRÈS IMPORTANT
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}