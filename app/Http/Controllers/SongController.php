<?php

namespace App\Http\Controllers;

use App\Utils\SpotifyService;
use Illuminate\Http\Request;

class SongController extends Controller
{

    public function index(){

        $spotify = new SpotifyService();
        $spotify->searchTrack();


    }



}
