<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Intervention extends Model
{
    protected $table = 'interventions';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'ticket_id',
        'date_debut',
        'date_fin',
        'statut_terrain',
        'description'
    ];

    protected $casts = [
        'id' => 'string',
        'date_debut' => 'datetime',
        'date_fin' => 'datetime'
    ];

    public $timestamps = true;

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    // 🔗 Intervention appartient à un Ticket
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    // 🔗 Récupérer la Zone via Ticket
    public function zone()
    {
        return $this->ticket->zone();
    }


    // ✔️ Vérifier si intervention est en cours
    public function isEnCours(): bool
    {
        return in_array($this->statut_terrain, ['EN_ROUTE', 'EN_COURS']);
    }

    // ✔️ Vérifier si intervention est terminée
    public function isTerminee(): bool
    {
        return $this->statut_terrain === 'TERMINEE';
    }
}
