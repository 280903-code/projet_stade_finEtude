<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Horaire extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'jour_semaine',
        'heure_debut',
        'heure_fin',
        'disponible',
        'raison_blocage',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'disponible' => 'boolean',
        ];
    }

    /**
     * Relation: Un horaire appartient à un terrain
     */
    public function terrain(): BelongsTo
    {
        return $this->belongsTo(Terrain::class);
    }
}