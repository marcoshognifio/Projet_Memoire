<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    public function connection()
    {
        return view('user.connection');
    }

    public function login()
    {
        return view('user.login');
    }

    public function do_login(LoginFormRequest $request)
    {
        $user = $request->validated();
        if(Auth::attempt($user)){
            $request->session()->regenerate();
            return redirect()->intended(route('user.index'));
        }
        else{

            return(view('user.login',[
                'email' => $request->input('email'),
                'error_login' => 'Mot de passe erroné ou Email erroné']));
        }
    }

    public function index()
    {
        $user = Auth::user();

        $projets = Projet::where('createur_id', '=', $user['id'])->where('projet_parent_id','=',NULL)->get();
        
        return view('user.index',['projets'=>$projets]);
    }

    public function create()
    {
        return view('user.form',['utilisateur' => new User()]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFormRequest $request)
    {
        User::create($this->validUser($request,new User()));
        return redirect()->route('accueil')->with('success_use',"Vous venez de créer un compte"); 
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
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
