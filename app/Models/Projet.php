<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Projet extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nom',
        'createur_id',
        'administrateur_id',
        'projet_parent_id',
        'description',
        'budget',
        'date_fin',
        'image'
    ];

    public function administrateur(): BelongsTo
    {
        return $this->belongsTo(User::class,'administrateur_id');
    }

    public function imageUrl():string 
    {
        return Storage::disk('public')->url($this->image);
    }

}
