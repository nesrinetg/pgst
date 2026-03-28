<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'titre',
        'description',
        'statut',
        'priorite',
        'zone_id',
        'deadline_at'
    ];

    protected $casts = [
        'id' => 'string',
        'deadline_at' => 'datetime'
    ];

    public $timestamps = true;

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    // 🔗 Ticket appartient à une Zone
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    // 🔗 Ticket possède plusieurs interventions
    public function interventions(): HasMany
    {
        return $this->hasMany(Intervention::class, 'ticket_id');
    }

   

    // ✔️ Vérifier si SLA respecté
    public function isSlaRespected(): bool
    {
        return $this->statut === 'CLOTURE' || $this->deadline_at >= now();
    }

    // ✔️ Vérifier si en retard
    public function isLate(): bool
    {
        return $this->deadline_at < now() && $this->statut !== 'CLOTURE';
    }
}
