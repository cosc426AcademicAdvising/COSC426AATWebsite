<?php
// Package requirement via composer package manager for Requests library
require 'vendor/autoload.php';

function getSchools(){
    $token = 'v2.public.eyJ1cm46ZXhhbXBsZTpjbGFpbSI6IkRCIEFjY2VzcyIsImlhdCI6IjIwMjEtMDktMThUMjE6MzY6MTQuNjQwWiJ96u8pkJNzmYgaDyweQAcH1XzVbwPF_Yw-CNjv0BGhWoTBcaP-07UbnBFonr7UYkqNWJz5dtxqHJ7G1x1Wws2ACg';
    //  First parameter is the address of API, second parameter is any necesarry headers packed into an array
    $response = Requests::get('https://cosc426restapi.herokuapp.com/api/Department/School', array('auth-token' => $token));
    // Decode into json object the response
    $schools = json_decode($response->body, true);
    // Return list
    return $schools;
}
?>