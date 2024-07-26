<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionFormRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Projet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    
    public function save_transaction(TransactionFormRequest $request,int $projet_id){

        $data = $request->validated();
        $projet = Projet::find($projet_id);
        $data['projet_emetteur_id'] = $projet['id'];
        $nbre = floatval($projet['recette_actuelle'])-floatval($projet['depense_actuelle'])-floatval($projet['transactions']);
        if($nbre >= floatval($data['montant']))
        {
            $projet['transactions'] = floatval($projet['transactions']) + floatval($data['montant']);
            $projet->save();
            $destinat = Projet::find($data['projet_destinataire_id']);
            $destinat->recette_actuelle = floatval( $destinat->recette_actuelle) + floatval($data['montant']);
            $destinat->save();

            Transaction::create($data);
            return response()->json([
                'success' => true,
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
            ]);
        }
        
    }

    public function ajoutfond(TransactionFormRequest $request,int $projet)
    {
        $data = $request->validated();
        $projet = Projet::find($projet);
        $projet->recette_actuelle = floatval($data['montant']) + floatval($projet['recette_actuelle']);
        
        $projet->save();
        $transactions= Transaction::create($data);

        return response()->json([
            'success' => true,
        ]);
    }

    
    public function transactions_effectuees(int $projet)
    {
        $transactions = Transaction::where('projet_emetteur_id', '=', $projet)
                                    ->orderBy('created_at')
                                    ->orderBy('projet_destinataire_id')
                                    ->get()
                                    ->groupBy('projet_destinataire_id');
                                    

        $groupedElements = [];
        foreach($transactions as $id=>$items)
        {
            $groupedElements[]= [
                'id' => $id,
                 'items' => TransactionResource::collection($items)
            ];
        }

        $keys = array_column($groupedElements, 'id');
        array_multisort($keys, SORT_ASC, $groupedElements);
        
        $transactions = Transaction::select('projet_destinataire_id', 
                    DB::raw('SUM(montant) as montant_total'))
                        ->where('projet_emetteur_id', '=', $projet)
                        ->orderBy('projet_destinataire_id')
                        ->groupBy('projet_destinataire_id')
                        ->get();

      
        return response()->json([
            'transactions_effectuees' =>$groupedElements,
            'montants_transactions' => $transactions
        ]);                            
    }

    public function transactions_recues(int $projet)
    {
        $transactions = TransactionResource::collection(Transaction::where('projet_destinataire_id', '=', $projet)->get());                                   

        return response()->json($transactions);
    }


}
