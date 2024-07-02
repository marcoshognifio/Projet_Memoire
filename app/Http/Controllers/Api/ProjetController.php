<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function sous_projets(string $user,string $projet)
    {
        $projets = Projet::where('projet_parent_id', '=', $projet)->get();
        
        return $projets;
    }
}
