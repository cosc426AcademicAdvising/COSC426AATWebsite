<?php
// Package requirement via composer package manager for Requests library
// require 'vendor/autoload.php';
// API Access Token
// include_once 'getToken.php';
// $token = getToken();

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

function newPass($sid, $hsh){
  global $token;
  $url = "https://cosc426restapi.herokuapp.com/api/Update/NewPass";
  $headers = array('Content-Type' => 'application/json','auth-token' => $token);
  $arr = array("s_id"=>$sid, "passHash"=>$hsh);
  $send = json_encode($arr);
  echo $send;
  $response = Requests::post($url, $headers, $send);
  return $response;
}

function createStudent($vals){
	global $token;
	$sid=$vals['s_id'];
	$url = 'https://cosc426restapi.herokuapp.com/api/Student/'.$sid;
	$response = Requests::post($url, array('auth-token' => $token), $vals);
	return $response;
}

// returns 1 if draft is present otherwise 0
function isDraftPresent($sid) {
  global $token;
  $url = 'https://cosc426restapi.herokuapp.com/api/Draft/draftExists/'.$sid;
  $response = Requests::get($url, array('auth-token' => $token));
  $draft_status = json_decode($response->body, true);
  return $draft_status;
}

function getDraft($sid) {
  global $token;
  $url = 'https://cosc426restapi.herokuapp.com/api/Draft/getDraft/'.$sid;
  $response = Requests::get($url, array('auth-token' => $token));
  $draft = json_decode($response->body, true);
  return $draft;
}

function deleteDraft($sid) {
  global $token;
  $url = 'https://cosc426restapi.herokuapp.com/api/Draft/Delete/'.$sid;
  $response = Requests::post($url, array('auth-token' => $token));
  return $response;
}
