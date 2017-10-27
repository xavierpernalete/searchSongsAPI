<?php

namespace App\Utils;
use App\Models\Sessions;
use App\Models\SessionsSpotify;

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


    public function makeAuthorizationAPI()
    {

        $params = $this->assembleRequestAuth();
        $url = $this->authURL."authorize/?".'scope=user-read-private%20user-read-email&'.http_build_query($params);


        $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
            CURLOPT_FOLLOWLOCATION, 0,
        ));
        $resp = curl_exec($curl);
        $redirectURL = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        curl_close($curl);


        dd($redirectURL, $this->authURL."authorize/?".http_build_query($params).$resp);



    }

    private function assembleRequestAuth()
    {

        $params = array(
            "response_type" => "code",
            "client_id" => $this->client_id,
           // "scope" => "user-read-private%20user-read-email",
            "redirect_uri" => $this->redirect_uri,
            "state" => "34fFs29kd09",

        );

        return $params;
    }


    public function searchTrack()
    {

        $auth = $this->makeAuthorizationAPI();


    }


}