<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'objet',
        'projet_id'
    ];

    public function articles(){
        return $this->hasMany(Article::class,'depense_id');
    }

    public function depense(){

        return $this-> belongsTo(Projet::class,'projet_id');
    }

}
