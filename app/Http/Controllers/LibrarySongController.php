<?php

namespace App\Http\Controllers;

use App\Utils\SpotifyService;
use App\Utils\Traits\ResponseTraits;
use Illuminate\Http\Request;

class LibrarySongController extends Controller
{

    use ResponseTraits;


    public function index(Request $request){







    }


    public function store(Request $request){

        if(trim(strtolower($request->import)) == "spotify" && isset($request->id)){

            $spotify    = new SpotifyService();
            $response   = $spotify->trackDetails($request->id);
            return  $this->sendResponse($response, 'songs');

        }






    }
}
