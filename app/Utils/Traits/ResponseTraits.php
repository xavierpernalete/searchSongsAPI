<?php

namespace App\Utils\Traits;
/**
 * Created by PhpStorm.
 * User: xpernalete
 * Date: 10/27/2017
 * Time: 5:20 AM
 */

trait ResponseTraits
{


    public function sendResponse($result, $element , $message)
    {

        if ($result != null || !empty($result)) {

            $response[$element] = $result;
            $response['status'] = true;
            $response['message'] = $message;

            return json_encode($response);
        }

        $response[$element] = "Songs no exits , or no found";
        $response['status'] = false;
        $response['message'] = $message;
        return json_encode($response);

    }


}