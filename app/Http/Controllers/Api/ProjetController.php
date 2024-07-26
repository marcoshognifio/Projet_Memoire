<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AjoutFOndFormRequest;
use App\Http\Requests\ProjetFormRequest;
use App\Http\Resources\ProjetResource;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjetController extends Controller
{
    public function sous_projets(string $projet)
    {
        $projets =ProjetResource::Collection( Projet::where('projet_parent_id', '=', $projet)->get());
        
        return  response()->json($projets);
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

    public function change_admin(Request $request, int $projet ){

        $projet = Projet::find($projet);
        $projet->administrateur_id = intval($request->all()['user_id']);
        $projet->save();

        return response()->json([
            'success' => true,
            'user' => $projet
        ]);

    }

    public function delete(Request $request)
    {
        $projet = Projet::find($request->all()['projet_id']);
        $projet->delete();
        return response()->json([
            'success' => true
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
