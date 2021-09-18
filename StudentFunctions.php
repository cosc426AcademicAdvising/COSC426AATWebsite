<?php
// Package requirement via composer package manager for Requests library
require 'vendor/autoload.php';
// API Access Token
$token = 'v2.public.eyJ1cm46ZXhhbXBsZTpjbGFpbSI6IkRCIEFjY2VzcyIsImlhdCI6IjIwMjEtMDktMThUMjE6MzY6MTQuNjQwWiJ96u8pkJNzmYgaDyweQAcH1XzVbwPF_Yw-CNjv0BGhWoTBcaP-07UbnBFonr7UYkqNWJz5dtxqHJ7G1x1Wws2ACg';

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
