<?php

namespace App\Http\Controllers;

use App\Models\Song;
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
            $result   = $spotify->trackDetails($request->id);
            $this->saveSongs($result);
            return  $this->sendResponse($result, 'songs');

        }


    }

    private function saveSongs($result){


        if(!is_null($result) || !empty($result)){

            $song = new Song();
            $song->url          = $result[0]->url;
            $song->idspotify    = $result[0]->id;
            $song->songname     = $result[0]->songname;
            $song->artistid     = $result[0]->artistid;
            $song->artistname   = $result[0]->artistname;
            $song->albumid      = $result[0]->albumid;
            $song->albumname    = $result[0]->albumname;
            $song->save();

        }

    }



}
