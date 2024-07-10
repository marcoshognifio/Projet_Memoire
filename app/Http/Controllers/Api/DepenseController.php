<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleFormRequest;
use App\Http\Requests\DepenseFormRequest;
use App\Models\Article;
use App\Models\Depense;
use App\Models\Projet;
use App\Models\Stand;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    public function index(string $projet_id){

        $stands = Stand::all();
        return view('projet.depense',['projet' => $projet_id,'articles' => $stands]);
    }

    public function create_article(string $projet_id){

        return view('projet.create_article',['projet' => $projet_id]);
    }
    
    public function store_article(ArticleFormRequest $request,string $projet_id){

        Stand::create($request->validated());
        
        return redirect()->route('user.projet.depense.index',$projet_id);
    }

    public function store(DepenseFormRequest $request, Projet $projet)
    {
        $stands = Stand::all();
       
        if(!$stands->isEmpty())
        {
            Stand::truncate();
            $montant = 0;
            foreach($stands as $stand)
            {
                $montant = $montant + $stand->montant;
            }

            if(floatval($projet['budget']) >= $montant)
            {
                $data = $request->Validated();
                $data['projet_id'] = $projet['id'];
                $data['montant'] = 0;
                $depense = Depense::create($data);
                $projet['budget'] = floatval($projet['budget']) - $montant;
                $projet->save();
                foreach($stands as $stand)
                {
                    $article = $stand->article();
                    $article['depense_id'] = $depense['id'];
                    Article::create($article);
                    $montant = $montant + $stand->montant;
                    $stand->delete();
                }

                $depense->montant = $montant;
                $depense->save();
                return redirect()->route('user.projet.show',$projet)->with('success',
                "La depense a ete effectuee avec succes");
            
            }
            else
            {
                return redirect()->route('user.projet.show',$projet)->with('success',
                "Votre fond est insuffisant pour effectuer cette depense");
            }
        }
        else
        {
            return redirect()->route('user.projet.depense.index',$projet)->with('success',
                "Vous n'aviez ajoute aucun article");
        }
    }
}
