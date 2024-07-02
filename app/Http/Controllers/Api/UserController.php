<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Resources\UserResource;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(LoginFormRequest $request)
    {
        $user = $request->validated();
        if(Auth::attempt($user)){
           
            return response()->json([
                'success' => true,
                'user' => new UserResource(Auth::user())
            ]);
        }
        else{

            return response()->json([
                'success' => false
            ]);
        }
    }

    public function projets(string $id)
    {
        $user = Auth::user();
        
        return $projets = Projet::where('createur_id', '=', $id)->where('projet_parent_id','=',NULL)->get();
    }
}
