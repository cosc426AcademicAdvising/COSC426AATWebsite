<?php
// Package requirement via composer package manager for Requests library
// require 'vendor/autoload.php';
// API Access Token
// include_once 'getToken.php';
// $token = getToken();

// Get all distinct shcools
//echo $val[0]
function getSchools(){
    //  First parameter is the address of API, second parameter is any necesarry headers packed into an array
    $response = Requests::get('https://cosc426restapi.herokuapp.com/api/Department/School', array('auth-token' => $_SESSION['token']));
    // Decode into json object the response
    $schools = json_decode($response->body, true);
    // Return list
    return $schools;
}

// Get all majors
function getMajors(){
    $response = Requests::get('https://cosc426restapi.herokuapp.com/api/Department/Major', array('auth-token' => $_SESSION['token']));
    $major = json_decode($response->body, true);
    return $major;
}

// Get all minors
function getMinors(){
    $response = Requests::get('https://cosc426restapi.herokuapp.com/api/Department/Minor', array('auth-token' => $_SESSION['token']));
    $major = json_decode($response->body, true);
    return $major;
}

// Get all Majors under a school
// echo $val[0]['Acad Plan'];
function getMajorsbySchool($school){
    $url = 'https://cosc426restapi.herokuapp.com/api/Department/Major/'.$school;
    $response = Requests::get($url, array('auth-token' => $_SESSION['token']));
    $major = json_decode($response->body, true);
    return $major;
}

// Get all minors under a school
// echo $val[0]['Acad Plan'];
function getMinorsbySchool($school){
    $url = 'https://cosc426restapi.herokuapp.com/api/Department/Minor/'.$school;
    $response = Requests::get($url, array('auth-token' => $_SESSION['token']));
    $minor = json_decode($response->body, true);
    return $minor;
}
