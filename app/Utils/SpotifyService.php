<?php

namespace App\Utils;

use App\Models\Sessions;
use Log;


/**
 * Created by PhpStorm.
 * User: xpernalete
 * Date: 10/26/2017
 * Time: 10:23 PM
 */
class SpotifyService
{
    protected $client_id = "82437470a7284dc0a874d34cf8df38c3";
    protected $client_secret = "62345f83602e464991dc5892819b6037";
    protected $redirect_uri = "http://searchsongsapi.dev/api/callback";
    protected $authURL = "https://accounts.spotify.com/";


    public function searchTrack($params)
    {

      try {
          $post = $this->setRequest($params);
          $access_token = $this->access_token();

          $authorization = "Authorization: Bearer " . $access_token->access_token;
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/search?' . http_build_query($post));
          curl_setopt($ch, CURLOPT_POST, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          $result = curl_exec($ch);
          curl_close($ch);
          $result = $this->setSongInformation($result);

          return json_decode($result);
      }catch (\Exception $e){

          Log::info('Error search by Spotify' . $e->getMessage());
      }

    }


    public function trackDetails($id)
    {

        try {

            $access_token = $this->access_token();

            $authorization = "Authorization: Bearer " . $access_token->access_token;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/tracks/'.$id);
            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            $result = $this->setSongInformationDetaills($result);

            return json_decode($result);
        }catch (\Exception $e){

            Log::info('Error search by Spotify' . $e->getMessage());
        }

    }




    private function access_token()
    {
        try{
        $base64 = base64_encode($this->client_id . ':' . $this->client_secret);
        $authorization = "Authorization: Basic " . $base64;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token?grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded', $authorization]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
        }catch (\Exception $e){

            Log::info('Error make access token By Spotify' . $e->getMessage());

        }

    }

    private function setRequest($params)
    {

        $post = array(
            "q" => isset($params['search']) ? $params['search'] : '',
            "type" => isset($params['type']) ? $params['type'] : "track,album"
        );

        return $post;

    }

    private function setSongInformation($result)
    {

        $result = json_decode($result);
        $songs = null;

        foreach ($result->tracks->items as $key => $item) {

            $songs[] = array(
                "url"=> $item->uri,
                "id"=> $item->id,
                "songname"=> $item->name,
                "artistid"=> $item->artists[0]->id,
                "artistname"=> $item->artists[0]->name,
                "albumid"=> $item->album->id,
                "albumname"=> $item->album->name,
            );

        }

        return json_encode($songs);

    }

    private function setSongInformationDetaills($result)
    {

        $result = json_decode($result);

        $songs = null;

            $songs[] = array(
                "url"=> $result->uri,
                "id"=> $result->id,
                "songname"=> $result->name,
                "artistid"=> $result->artists[0]->id,
                "artistname"=> $result->artists[0]->name,
                "albumid"=> $result->album->id,
                "albumname"=> $result->album->name,
            );

        return json_encode($songs);

    }



}