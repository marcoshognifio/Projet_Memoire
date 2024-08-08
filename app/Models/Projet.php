<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Cast\Double;

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
        'budget_prevu',
        'recette_actuelle',
        'depense_actuelle',
        'transactions',
        'date_fin',
        'image'
    ];

    public function administrateur(): BelongsTo
    {
        return $this->belongsTo(User::class,'administrateur_id');
    }

    public function imageUrl() 
    {

        return $this->image != null ? Storage::disk('public')->url($this->image):null;
    }

    public function fond_restant():float
    {
        return  floatval($this->recette_actuelle)-floatval($this->depense_actuelle)-floatval($this->transactions);
    }
    
    public function projets(){

        return $this-> hasMany(Projet::class,'projet_parent_id')->onDelete('cascade');
    }

    public function depenses(){

        return $this-> hasMany(Projet::class,'projet_id')->onDelete('cascade');
    }

    public function transactions(){

        return $this-> hasMany(Projet::class,'projet_emetteur_id')->onDelete('cascade');
    }

}
