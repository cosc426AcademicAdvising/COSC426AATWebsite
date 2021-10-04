<?php
// Package requirement via composer package manager for Requests library
require 'vendor/autoload.php';
// API Access Token
include_once 'getToken.php';
$token = getToken();

// Get all subjects
// echo $val[0];
function getSubjects(){
    global $token;
    $response = Requests::get('https://cosc426restapi.herokuapp.com/api/Course/Subject', array('auth-token' => $token));
    $subs = json_decode($response->body, true);
    return $subs;
}

// Search course by subject and catalog
// echo $val[0]['Long Title'];
// Array ( [0] => Array ( [Allowd Unt] => 4.00 [Long Title] => PROGRAMMING FUNDAMENTALS [Subject] => COSC [Catalog] => 117 ) )
function getCoursebySubCat($sub, $cat){
    global $token;
    $url = 'https://cosc426restapi.herokuapp.com/api/Course/'.$sub.'/'.$cat;
    $response = Requests::get($url, array('auth-token' => $token));
    $course = json_decode($response->body, true);
    return $course;
}

function getCoursebyRegex($sub, $cat, $title, $cred){
    global $token;
    $url = 'https://cosc426restapi.herokuapp.com/api/Course/Regex';
    $headers = array('Content-Type' => 'application/json', 'auth-token' => $token);
    $param = array( 'subject' => $sub, 'catalog' => $cat, 'title' => $title, 'credit' => $cred );
    $response = Requests::post($url, $headers, json_encode($param));
    var_dump($response->body);
    $course = json_decode($response->body, true);
    return $course;
}
?>
