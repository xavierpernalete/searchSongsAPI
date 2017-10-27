<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Utils\SpotifyService;
use App\Utils\Traits\ResponseTraits;
use Illuminate\Http\Request;
use Log;

class LibrarySongController extends Controller
{

    use ResponseTraits;


    public function index(Request $request)
    {
        try {

            $songs = Song::where($request->all())->get()->take(isset($limit) ? $limit : 20)->toArray();

            if (is_array($songs) && !empty($songs)) {

                return $this->sendResponse($songs, 'songs', 'Completed Search');

            }

            return $this->sendResponse(null, 'songs', 'Song No Exits ');
        } catch (\Exception $e) {

            Log::info('Error Showed songs ' . $e->getMessage());
        }

    }


    public function store(Request $request)
    {
        try {

            if (trim(strtolower($request->import)) == "spotify" && isset($request->idSpotify)) {

                $spotify = new SpotifyService();
                $result = $spotify->trackDetails($request->idSpotify);
                $this->saveSongs($result);
                return $this->sendResponse($result, 'songs', 'Completed Import');

            }

            $songs = $this->createNewSong($request->all());
            if (is_array($songs)) {

                return $this->sendResponse($songs, 'songs', 'Completed Created');

            }

            return $this->sendResponse(null, 'songs', 'Missing Parameter: ' . $songs);
        } catch (\Exception $e) {

            Log::info('Error Showed songs ' . $e->getMessage());
        }

    }


    public function show($id)
    {
        try {
            $song = Song::find($id);
            if (!empty($song)) {
                $song = $song->toArray();
                return $this->sendResponse($song, 'songs', 'Completed Search');

            }

            return $this->sendResponse(null, 'songs', 'Song No Exits');
        } catch (\Exception $e) {

            Log::info('Error Showed songs ' . $e->getMessage());

        }

    }

    public function destroy($id)
    {

        try {
            $song = Song::find($id);

            if (empty($song)) {

                return $this->sendResponse(null, 'songs', 'Song no exits ');

            }

            $song->delete($id);

            return $this->sendResponse($song, 'songs', 'Completed Deleted');

        } catch (\Exception $e) {

            Log::info('Error deleted songs ' . $e->getMessage());
        }

    }

    private function saveSongs($result)
    {

        try {

            if ((!is_null($result) || !empty($result))) {
                $songExit = Song::where('idspotify', $result[0]->id)->first();

                if (empty($songExit)) {

                    $song = new Song();
                    $song->url = $result[0]->url;
                    $song->idspotify = $result[0]->id;
                    $song->songname = $result[0]->songname;
                    $song->artistid = $result[0]->artistid;
                    $song->artistname = $result[0]->artistname;
                    $song->albumid = $result[0]->albumid;
                    $song->albumname = $result[0]->albumname;
                    $song->save();
                }

            }
        } catch (\Exception $e) {

            Log::info('Error saved songs ' . $e->getMessage());

        }

    }

    private function createNewSong($params)
    {
        try {

            $requires = array(
                "url", "songname", "artistname",
            );
            foreach ($requires as $require) {

                if (!array_key_exists($require, $params)) {

                    return $require;
                }

            }
            $song = Song::create($params);

            return $song->toArray();
        } catch (\Exception $e) {

            Log::info('Error create songs ' . $e->getMessage());
        }
    }


}
