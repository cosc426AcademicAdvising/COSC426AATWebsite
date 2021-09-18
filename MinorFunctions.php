<?php
// Package requirement via composer package manager for Requests library
require 'vendor/autoload.php';
// API Access Token
$token = 'v2.public.eyJ1cm46ZXhhbXBsZTpjbGFpbSI6IkRCIEFjY2VzcyIsImlhdCI6IjIwMjEtMDktMThUMjE6MzY6MTQuNjQwWiJ96u8pkJNzmYgaDyweQAcH1XzVbwPF_Yw-CNjv0BGhWoTBcaP-07UbnBFonr7UYkqNWJz5dtxqHJ7G1x1Wws2ACg';

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