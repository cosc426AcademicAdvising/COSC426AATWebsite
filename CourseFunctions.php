<?php
// Package requirement via composer package manager for Requests library
require 'vendor/autoload.php';
// API Access Token
$token = 'v2.public.eyJ1cm46ZXhhbXBsZTpjbGFpbSI6IkRCIEFjY2VzcyIsImlhdCI6IjIwMjEtMDktMThUMjE6MzY6MTQuNjQwWiJ96u8pkJNzmYgaDyweQAcH1XzVbwPF_Yw-CNjv0BGhWoTBcaP-07UbnBFonr7UYkqNWJz5dtxqHJ7G1x1Wws2ACg';

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
function getCoursebySubCat($sub, $cat){
    global $token;
    $url = 'https://cosc426restapi.herokuapp.com/api/Course/'.$sub.'/'.$cat;
    $response = Requests::get($url, array('auth-token' => $token));
    $course = json_decode($response->body, true);
    return $course;
}

?>