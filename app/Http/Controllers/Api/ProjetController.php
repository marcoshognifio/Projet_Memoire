<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AjoutFOndFormRequest;
use App\Http\Requests\ProjetFormRequest;
use App\Http\Resources\ProjetResource;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjetController extends Controller
{
    public function sous_projets(string $projet)
    {
        $projets =ProjetResource::Collection( Projet::where('projet_parent_id', '=', $projet)->get());
        
        return $projets;
    }

    public function create_projet(ProjetFormRequest $request)
    {
     
        $data = $this->validProjet($request,new Projet());
        $projet = Projet::create($data);
        return response()->json([
            'success' => true,
            'projet' => $projet
        ]);
    }

    public function ajoutfond(AjoutFOndFormRequest $request,int $projet)
    {
        $data = floatval($request->validated()['fond']);
        $projet = Projet::find($projet);
        $projet->budget = $data + floatval($projet['budget']);
        $projet->save();
        return response()->json([
            'success' => true,
            'projet' => $projet
        ]);
    }

    private function validProjet(ProjetFormRequest $request,Projet $projet){

        $data =$request->validated();
        $image =null;
        if(isset($request->validated()['image'])){

            $image =$request->validated()['image'];
            if(!$image->getError()){
                    $data['image'] = $image->store('projets_images','public');
            }

            if($projet->image){
                Storage::disk('public')->delete($projet->image);
            }
        } 
                
        return $data;
    }
}
