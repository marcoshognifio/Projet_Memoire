<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'quantite',
        'montant',
        'depense_id',
    ];

    public function article()
    {
        return [
            'nom' => $this->nom,
            'quantite' => $this->quantite,
            'montant'  => $this->montant
        ];
    }
}
