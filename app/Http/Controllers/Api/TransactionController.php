<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionFormRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Projet;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    
    public function save_transaction(TransactionFormRequest $request,int $projet_id){

        $data = $request->validated();
        $projet = Projet::find($projet_id);
        $data['projet_emetteur_id'] = $projet['id'];
        if(floatval($projet['budget']) >= floatval($data['montant']))
        {
            $projet['budget'] = floatval($projet['budget']) - floatval($data['montant']);
            $projet->save();
            $destinat = Projet::find($data['projet_destinataire_id']);
            $destinat->budget = floatval( $destinat->budget) + floatval($data['montant']);
            $destinat->save();

            Transaction::create($data);
            return response()->json([
                'success' => true,
            ]);
        }
        else
        {
            return response()->json([
                'success' => true,
            ]);
        }
        
    }

    public function transactions(int $projet)
    {
        $transactions_effect =TransactionResource::Collection( Transaction::where('projet_emetteur_id', '=', $projet)->get());
        $transactions_recues =TransactionResource::Collection( Transaction::where('projet_destinataire_id', '=', $projet)->get());
        return response()->json([
            'transactions_effectuees' => $transactions_effect,
            'transactions_recues' => $transactions_recues
        ]);
    }
}
