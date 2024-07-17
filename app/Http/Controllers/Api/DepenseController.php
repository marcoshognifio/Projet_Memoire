<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleFormRequest;
use App\Http\Requests\DepenseFormRequest;
use App\Http\Resources\DepenseResource;
use App\Models\Article;
use App\Models\Depense;
use App\Models\Projet;
use App\Models\Stand;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    public function index(int $projet_id){

        $depenses =DepenseResource::Collection( Depense::where('projet_id', '=', $projet_id)->get());
        
        return response()->json($depenses);
    }


    public function store(Request $request, int $projet)
    {
        $a = $request->all();
        $depense = $a["depense"][0];
        $articles = $a["articles"];
        $depense['projet_id'] = $projet;
        $depense = Depense::create($depense); 
        
        foreach($articles as $article)
        {
            $article['depense_id'] = $depense['id'];
            Article::create($article);
        }

        $projet = Projet::find($projet);
        $projet['budget'] = floatval($projet['budget']) - floatval($depense['montant']);
        $projet->save();

        return response()->json([
            'success' => true,
            'projet' => $depense
        ]);
        
    }

}
