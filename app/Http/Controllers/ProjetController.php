<?php

namespace App\Http\Controllers;

use App\Http\Requests\AjoutFOndFormRequest;
use App\Http\Requests\ProjetFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests\ProjetFormRequestForm;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjetController extends Controller
{
   
    public function create()
    {
        return view('projet.form',['projet' => new Projet()]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjetFormRequest $request)
    {
       $data = $this->validProjet($request,new Projet());
       $data['nom'] = strtolower($data['nom']);
       $data['createur_id'] = Auth::user()['id'];
        Projet::create($data);
        return redirect()->route('accueil')->with('success_use',"Vous venez de créer un compte"); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        $projets = Projet::where('projet_parent_id', '=', $projet['id'])->get();
        
        return view('user.projet.index',['projets'=>$projets,'projet_actuel'=>$projet]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function create_ajoutfond(Projet $projet)
    {
        return view('projet.ajout_fond',['projet' => $projet]);
    }

    public function store_ajoutfond(AjoutFOndFormRequest $request,Projet $projet)
    {
        $data = floatval($request->validated()['fond']);
        $projet->budget = $data + floatval($projet['budget']);
        $projet->save();

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



 
   

