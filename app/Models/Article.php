<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'quantite',
        'montant',
        'depense_id',
    ];


    public function depense(): BelongsTo
    {
        return $this->belongsTo(Depense::class);
    }
}
