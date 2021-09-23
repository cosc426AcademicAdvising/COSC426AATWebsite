<?php
// Package requirement via composer package manager for Requests library
require 'vendor/autoload.php';
// API Access Token
include_once 'getToken.php';
$token = getToken();

// Get student json file
// echo $val['name'];
// echo $val['course_taken][0]['semester_1][0]['subject]
function getStudent($sid){
    global $token;
    $url = 'https://cosc426restapi.herokuapp.com/api/Student/'.$sid;
    $response = Requests::get($url, array('auth-token' => $token));
    $student = json_decode($response->body, true);
    return $student;
}

?>
