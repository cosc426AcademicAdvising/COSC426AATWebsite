<?php
// Package requirement via composer package manager for Requests library
require 'vendor/autoload.php';
// API Access Token
include_once 'getToken.php';
$token = getToken();

// Get Minor Plan for minor
// echo $val['crs1'][0]['subject'];
function getMinorPlan($min){
    global $token;
    $url = 'https://cosc426restapi.herokuapp.com/api/MinPlan/Plan/'.$min;
    $response = Requests::get($url, array('auth-token' => $token));
    $plan = json_decode($response->body, true);
    return $plan;
}

?>