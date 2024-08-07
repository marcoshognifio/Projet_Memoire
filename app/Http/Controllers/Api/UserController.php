<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Http\Resources\ProjetResource;
use App\Http\Resources\UserResource;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    public function login(LoginFormRequest $request)
    {
        $user = $request->validated();
        if(Auth::attempt($user)){
           $user = Auth::user();
           $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'success' => true,
                'user' => new UserResource(Auth::user()),
                'token' => $token
            ]);
        }
        else{

            return response()->json([
                'success' => false
            ]);
        }
    }

    public function authentification(LoginFormRequest $request){

        $user = $request->validated();
        if(Auth::guard('web')->attempt($user)){

            return response()->json([
                'success' => true
            ]);
        }
        else{

            return response()->json([
                'success' => false
            ]);
        }    

    }

    public function edit(Request $request,int $user_id){
        $a=$request->all();
        $user = User::find($user_id);
        
        $user->update($a);

        return response()->json([
            'success' => true,
            'user' => $user
        ]);
        
    }    

    public function save_user(UserFormRequest $request)
    {
        $user = User::create($this->validUser($request,new User()));
        return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }

    public function search(Request $request)
    {   
        $user = User::where('email', '=', $request->all()['email'])->get();
            
        if($user->isNotEmpty() == true)
            return response()->json([
                'success' => true, 
                'user' => $user[0]
            ]);
        else
            return   response()->json([
                'success' => false,
            ]); 
    }

    public function projets_admin(int $id)
    {
        return response()->json( ProjetResource::Collection(Projet::where('administrateur_id', '=', $id)->get()),
        ); 
    }

    public function projets_create(string $id)
    {
        return response()->json(
            ProjetResource::Collection(Projet::where('createur_id', '=', $id)->get()),  
        );
    }

    private function validUser(UserFormRequest $request,User $utilisateur){

        $data =$request->validated();
        $image =null;
        if(isset($request->validated()['image'])){
    
            $image =$request->validated()['image'];
            if(!$image->getError()){
                    $data['image'] = $image->store('users_images','public');
            }
    
            if($utilisateur->image){
                Storage::disk('public')->delete($utilisateur->image);
            }
        } 
    
        $data['name'] = strtolower($data['name']);
                
        return $data;
    }
}

