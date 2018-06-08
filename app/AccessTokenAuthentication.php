<?php
/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 5/28/2017
 * Time: 4:57 PM
 */

namespace App;


class AccessTokenAuthentication
{
    /*
         * Get the access token.
         *
         * @param string $azure_key    Subscription key for Text Translation API.
         *
         * @return string.
         */
    function getToken($azure_key)
    {
        $url = 'https://api.cognitive.microsoft.com/sts/v1.0/issueToken';
        $ch = curl_init();
        $data_string = json_encode('{body}');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'Ocp-Apim-Subscription-Key: ' . $azure_key
            )
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $strResponse = curl_exec($ch);
        curl_close($ch);
        return $strResponse;
    }
}