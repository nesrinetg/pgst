<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nom',
        'prenom',
        'telephone',
        'email',
        'password_hash',
        'role',
        'actif',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'actif' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->prenom} {$this->nom}";
    }

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope a query to only include inactive users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('actif', false);
    }

    /**
     * Scope a query to filter by role.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Check if user is admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'ADMIN';
    }

    /**
     * Check if user is supervisor.
     *
     * @return bool
     */
    public function isSuperviseur()
    {
        return $this->role === 'SUPERVISEUR';
    }

    /**
     * Check if user is sous-traitant.
     *
     * @return bool
     */
    public function isSousTraitant()
    {
        return $this->role === 'SOUSTRAITANT';
    }

    /**
     * Get role label.
     *
     * @return string
     */
    public function getRoleLabelAttribute()
    {
        return match($this->role) {
            'ADMIN' => 'Administrateur',
            'SUPERVISEUR' => 'Superviseur',
            'SOUSTRAITANT' => 'Sous-traitant',
            default => $this->role,
        };
    }

    /**
     * Get role badge class.
     *
     * @return string
     */
    public function getRoleBadgeClassAttribute()
    {
        return match($this->role) {
            'ADMIN' => 'badge-admin',
            'SUPERVISEUR' => 'badge-superviseur',
            'SOUSTRAITANT' => 'badge-soustraitant',
            default => 'badge-secondary',
        };
    }

    /**
     * Get status label.
     *
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        return $this->actif ? 'Actif' : 'Inactif';
    }

    /**
     * Get status badge class.
     *
     * @return string
     */
    public function getStatusBadgeClassAttribute()
    {
        return $this->actif ? 'badge-actif' : 'badge-inactif';
    }

    /**
     * Generate a unique ID for new user.
     *
     * @return string
     */
    public static function generateId()
    {
        return uniqid() . '_' . bin2hex(random_bytes(8));
    }
}