<?php

namespace App\Http\Controllers;

use App\Models\SessionsSpotify;
use Illuminate\Http\Request;

class SesionsController extends Controller
{


    public function callBack(Request $request){

        try {
             $input = $request->all();
             $sessionSpotify = new SessionsSpotify();
             $sessionSpotify->code = $input['code'];
             $sessionSpotify->state = $input['state'];
             $sessionSpotify->type = 'authorize';
             $sessionSpotify->save();

            return $sessionSpotify->toArray();

        } catch (\Exception $e){

            return $e->getMessage();

        }
    }
}
