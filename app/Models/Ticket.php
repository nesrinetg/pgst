<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'ticket_number',
        'client_number',
        'client_name',
        'client_phone',
        'client_address',
        'zone_id',
        'service_type',
        'priority',
        'sla_deadline',
        'status',
        'assigned_to',
        'description'
    ];

    protected $casts = [
        'sla_deadline' => 'datetime',
        'created_at' => 'datetime'
    ];

    /**
     * Boot method pour générer automatiquement le numéro de ticket
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($ticket) {
            // Générer un numéro de ticket unique
            $ticket->ticket_number = 'TKT-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            
            // Définir le SLA par défaut (24h)
            if (!$ticket->sla_deadline) {
                $ticket->sla_deadline = now()->addHours(24);
            }
        });
    }

    /**
     * Relation avec la zone
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * Relation avec le sous-traitant assigné
     */
    public function subcontractor()
    {
        return $this->belongsTo(Subcontractor::class, 'assigned_to');
    }

    /**
     * Relation avec l'intervention
     */
    public function intervention()
    {
        return $this->hasOne(Intervention::class);
    }

    /**
     * Vérifier si le ticket est en retard
     */
    public function isOverdue()
    {
        return Carbon::now()->gt($this->sla_deadline) && 
               !in_array($this->status, ['résolu', 'clôturé']);
    }

    /**
     * Calculer le temps restant avant dépassement SLA
     */
    public function getTimeRemainingAttribute()
    {
        if ($this->isOverdue()) {
            return 0;
        }
        return Carbon::now()->diffInMinutes($this->sla_deadline, false);
    }

    /**
     * Formater le temps restant
     */
    public function getFormattedTimeRemainingAttribute()
    {
        $minutes = $this->timeRemaining;
        
        if ($minutes <= 0) {
            return 'Délai dépassé';
        }
        
        $hours = floor($minutes / 60);
        $mins = $minutes % 60;
        
        if ($hours > 0) {
            return "{$hours}h {$mins}min";
        }
        
        return "{$mins}min";
    }
}