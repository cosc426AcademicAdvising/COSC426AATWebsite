<?php
// Package requirement via composer package manager for Requests library
require 'vendor/autoload.php';
$token = 'v2.public.eyJ1cm46ZXhhbXBsZTpjbGFpbSI6IkRCIEFjY2VzcyIsImlhdCI6IjIwMjEtMDktMThUMjE6MzY6MTQuNjQwWiJ96u8pkJNzmYgaDyweQAcH1XzVbwPF_Yw-CNjv0BGhWoTBcaP-07UbnBFonr7UYkqNWJz5dtxqHJ7G1x1Wws2ACg';

// Get all distinct shcools
//echo $val[0]
function getSchools(){
    global $token;
    //  First parameter is the address of API, second parameter is any necesarry headers packed into an array
    $response = Requests::get('https://cosc426restapi.herokuapp.com/api/Department/School', array('auth-token' => $token));
    // Decode into json object the response
    $schools = json_decode($response->body, true);
    // Return list
    return $schools;
}

// Get all majors
function getMajors(){
    global $token;
    $response = Requests::get('https://cosc426restapi.herokuapp.com/api/Department/Major', array('auth-token' => $token));
    $major = json_decode($response->body, true);
    return $major;
}

// Get all Majors under a school
// echo $val[0]['Acad Plan'];
function getMajorsbySchool($school){
    global $token;
    $url = 'https://cosc426restapi.herokuapp.com/api/Department/Major/'.$school;
    $response = Requests::get($url, array('auth-token' => $token));
    $major = json_decode($response->body, true);
    return $major;
}

// Get all minors under a school
// echo $val[0]['Acad Plan'];
function getMinorsbySchool($school){
    global $token;
    $url = 'https://cosc426restapi.herokuapp.com/api/Department/Minor/'.$school;
    $response = Requests::get($url, array('auth-token' => $token));
    $minor = json_decode($response->body, true);
    return $minor;
}
?>