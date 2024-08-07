<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaveImageController extends Controller
{
    public function upload_image(Request $request){

        $request->validate([
            'type' => 'required|',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $a = $request->all();
        $image = $a['image'];
        if($a['type'] == 'user'){
            $image = $image->store('users_images','public');
        }
        else{

            if($a['type'] == 'project'){
                $image = $image->store('projets_images','public');
            }
            else{
                $image = $image->store('depenses_images','public');
            }     

        }
        
         return response()->json([
                'success' => true,
                'path' => $image
            ]);
    }
}
