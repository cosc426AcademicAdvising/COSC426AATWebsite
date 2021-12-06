<?php

function getToken(){
    $usr = array('id' => 9999999, 'password' => 'suadvisors');
    $url = 'https://cosc426restapi.herokuapp.com/api/user/login/';
    $headers = array('Content-Type' => 'application/json');
    $response = Requests::post($url, $headers, json_encode($usr));
    $val = ($response->body);
    $token = $val;
    return $token;
}
