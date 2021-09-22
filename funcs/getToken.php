<?php

function getToken(){
    $usr = array('email' => 'testing@email.com', 'password' => 'test123');
    $url = 'https://cosc426restapi.herokuapp.com/api/user/login/';
    $headers = array('Content-Type' => 'application/json');
    $response = Requests::post($url, $headers, json_encode($usr));
    $val = ($response->body);
    $token = $val;
    return $token;

}
?>