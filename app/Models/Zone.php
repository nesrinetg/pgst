<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zone extends Model
{
    protected $table = 'zones';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'wilaya', 'commune', 'quartier'
    ];

    protected $casts = [
        'id' => 'string'
    ];

    public $timestamps = true;

    public function sousTraitants(): BelongsToMany
    {
        return $this->belongsToMany(SousTraitant::class, 'subcontractor_zones', 'zone_id', 'subcontractor_id')
                    ->withPivot('actif')
                    ->withTimestamps();
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'zone_id');
    }
}
