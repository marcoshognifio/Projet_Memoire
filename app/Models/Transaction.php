<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'projet_emetteur_id',
        'projet_destinataire_id',
        'objet'
    ];
}
