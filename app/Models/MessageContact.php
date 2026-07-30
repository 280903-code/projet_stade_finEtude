<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageContact extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'messages_contact';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'message',
        'lu',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'lu' => 'boolean',
        ];
    }
}