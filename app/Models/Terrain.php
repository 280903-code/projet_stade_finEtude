<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Terrain extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nom',
        'description',
        'adresse',
        'telephone',
        'email',
        'image',
        'prix_matin',
        'prix_apres_midi',
        'prix_soir',
        'horaire_ouverture',
        'horaire_fermeture',
        'actif',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'actif' => 'boolean',
            'prix_matin' => 'decimal:2',
            'prix_apres_midi' => 'decimal:2',
            'prix_soir' => 'decimal:2',
        ];
    }

    /**
     * Relation: Un terrain peut avoir plusieurs horaires
     */
    public function horaires(): HasMany
    {
        return $this->hasMany(Horaire::class);
    }

    /**
     * Relation: Un terrain peut avoir plusieurs réservations
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}