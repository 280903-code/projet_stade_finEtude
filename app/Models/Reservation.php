<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'date_reservation',
        'heure_debut',
        'heure_fin',
        'prix',
        'statut',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'date_reservation' => 'date',
            'heure_debut' => 'string',
            'heure_fin' => 'string',
            'prix' => 'decimal:2',
        ];
    }

    /**
     * Relation: Une réservation appartient à un utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope pour les réservations futures
     */
    public function scopeFutures($query)
    {
        return $query->where('date_reservation', '>=', now()->toDateString())
                     ->whereIn('statut', ['en_attente', 'confirmee'])
                     ->orderBy('date_reservation')
                     ->orderBy('heure_debut');
    }

    /**
     * Scope pour les réservations passées
     */
    public function scopePassees($query)
    {
        return $query->where('date_reservation', '<', now()->toDateString())
                     ->orWhere('statut', 'annulee')
                     ->orderBy('date_reservation', 'desc');
    }
}