<?php

namespace App\Http\Controllers;


use App\Utils\SpotifyService;
use App\Utils\Traits\ResponseTraits;
use Illuminate\Http\Request;



class SongController extends Controller
{

    use ResponseTraits;

    public function index(Request $request){

        $spotify    = new SpotifyService();
        $response  = $spotify->searchTrack($request->all());

        return $this->sendResponse($response , 'songs');


    }







}
