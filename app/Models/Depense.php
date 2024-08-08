<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'objet',
        'image',
        'projet_id'
    ];

    public function imageUrl() 
    {
        return $this->image != null ? Storage::disk('public')->url($this->image):null;
    }

    public function articles(){
        return $this->hasMany(Article::class,'depense_id');
    }

    public function depense(){

        return $this-> belongsTo(Projet::class,'projet_id');
    }

}
