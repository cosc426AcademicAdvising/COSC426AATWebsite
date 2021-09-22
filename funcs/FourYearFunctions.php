<?php
// Package requirement via composer package manager for Requests library
require 'vendor/autoload.php';
// API Access Token
include_once 'getToken.php';
$token = getToken();

// Get policy for a major's four year plan
// echo $val[0]['policies']
function getPolicybyMajor($maj){
    global $token;
    $url = 'https://cosc426restapi.herokuapp.com/api/FourYear/Policy/'.$maj;
    $response = Requests::get($url, array('auth-token' => $token));
    $student = json_decode($response->body, true);
    return $student;
}

// Get Four year plan for major by direct search
// echo $val['semester_1'][0]['subject']
function getFourYearbyMajor($maj){
    global $token;
    $url = 'https://cosc426restapi.herokuapp.com/api/FourYear/MajorPlan/'.$maj;
    $response = Requests::get($url, array('auth-token' => $token));
    $plan = json_decode($response->body, true);
    return $plan;
}

// Get four year plan for major by regex search
// echo $val['semester_1'][0]['subject']
function getFourYearbyMajorRegex($maj){
    global $token;
    $url = 'https://cosc426restapi.herokuapp.com/api/FourYear/MajorPLan/Regex/'.$maj;
    $response = Requests::get($url, array('auth-token' => $token));
    $plan = json_decode($response->body, true);
    return $plan;
}

?>