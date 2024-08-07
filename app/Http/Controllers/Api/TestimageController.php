<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestimageController extends Controller
{
    public function upload_image(Request $request){

        /*$data =$request->all();
        
        $image =null;
        if(isset($data['image'])){
    
            $image =$data['image'];
            if(!$image->getError()){
                    $data['image'] = $image->store('users_images','public');
            }
    
            
        } 
    
                
        return $data;*/

         return response()->json([
                'success' => true
            ]);
    }
}
