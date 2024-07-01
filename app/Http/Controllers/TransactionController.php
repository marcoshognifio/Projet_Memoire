<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionFormRequest;
use App\Models\Projet;
use App\Models\Transaction;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function create(Projet $projet){

        $projets = Projet::where('projet_parent_id', '=', $projet['id'])->get();
        $parent = Projet::find($projet['projet_parent_id']);
        if($parent != NULL )
        {
            $projets[] = $parent;
        }
        
        return view('projet.create_transaction',['projet' => $projet, 'projets' => $projets]);
    }
    
    public function store(TransactionFormRequest $request,Projet $projet){

        $data = $request->validated();
        $data['projet_emetteur_id'] = $projet['id'];
        if(floatval($projet['budget']) >= floatval($data['montant']))
        {
            $projet['budget'] = floatval($projet['budget']) - floatval($data['montant']);
            $projet->save();
            $destinat = Projet::find($data['projet_destinataire_id']);
            $destinat->budget = floatval( $destinat->budget) + floatval($data['montant']);
            $destinat->save();

            Transaction::create($data);
            return redirect()->route('user.projet.show',$projet)->with('success',
            "La transaction a ete effectuée avec succes");
        }
        else
        {
            return redirect()->route('user.projet.show',$projet)->with('success',
            "Votre fond est insuffisant pour effectuer la transaction");
        }
        
    }
}
