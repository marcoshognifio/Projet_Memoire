<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'projet_emetteur_id',
        'projet_destinataire_id',
        'objet'
    ];

    public function projet_emetteur(): BelongsTo
    {
        return $this->belongsTo(Projet::class,'projet_emetteur_id');
    }

    public function projet_destinataire(): BelongsTo
    {
        return $this->belongsTo(Projet::class,'projet_destinataire_id');
    }
}
