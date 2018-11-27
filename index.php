<?php
/* Copyright (C) Sam Hermans - All Rights Reserved
 * Written by Sam Hermans, 27/11/2018
 */

include_once 'settings.php';


$res =
var_dump($res);

class Trello {

    public static function GetBoards() {
        return Trello::call('/1/members/me/boards');
    }

    private static function call ($path, $extradata = false) {

        $data = ['key' => API_KEY, 'token' => API_TOKEN];
        // optional parameters
        if($extradata) {
            array_merge($data, $extradata);
        }

        // convert data to get parameters
        $params = '';
        foreach($data as $key=>$value) {
            $params .= $key.'='.$value.'&';
        }

        // remove trailing &
        $params = trim($params, '&');

        // call it
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.trello.com" . $path . '?' . $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }
}