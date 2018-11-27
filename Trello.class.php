<?php
/* Copyright (C) Sam Hermans - All Rights Reserved
 * Written by Sam Hermans, 27/11/2018
 */


require_once 'settings.php';

class Trello {

    public static function GetBoardListsAndCards($board_id) {
        return self::GetBoardLists($board_id, ['cards' => 'open', 'card_fields' => 'all']);
    }

    public static function GetBoardLists($board_id, $extradata = false) {
        return self::call('/1/boards/' . $board_id . '/lists', $extradata);
    }

    public static function GetBoard($board_id) {
        return self::call('/1/boards/' . $board_id);
    }

    public static function GetBoards() {
        return self::call('/1/members/me/boards');
    }

    private static function call ($path, $extradata = false) {

        $data = ['key' => API_KEY, 'token' => API_TOKEN];
        // optional parameters
        if($extradata) {
            $data = array_merge($data, $extradata);
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

        return json_decode($output, true);
    }
}