<?php
// Package requirement via composer package manager for Requests library
// require 'vendor/autoload.php';
// API Access Token
// include_once 'getToken.php';
// $token = getToken();

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

function displayFourYearPlan($fyp) {
    for ($n=1;$n<=8;$n++){
        echo '<div class="fyp_area'.$n.'" id="fyp_area'.$n.'">';
        echo "<div class='dash_header'>";
        echo "<h3> Semester ".$n.'</h3>';
        echo "</div>";
        echo "<div class='table_area'>";
        echo "<table class='fyp_semester'>";
        echo '<thead>';
        echo '<tr>';
        echo '<th style="border-radius: 10px 0px 0px 0px;">Course Number</th>';
        echo '<th>Title</th>';
        echo '<th style="border-radius: 0px 10px 0px 0px;">Credit</th>';
        echo '</tr>';
        echo '</thead>';
        for ($i=0;$i<count($fyp["semester_".$n]);$i++){

            if($i+1 == count($fyp['semester_'.$n])) {
                $style_subject = 'border-left: none; border-bottom: none; width: 25%; border-radius: 0 0 0 10px;';
                $style_title = 'border-bottom: none; width: 60%;';
                $style_credit = 'border-right: none; border-bottom: none; width: 15%; border-radius: 0 0 10px 0;';
            }
            else {
                $style_subject = 'border-left: none; width: 25%;';
                $style_title = 'width: 60%;';
                $style_credit = 'border-right: none; width: 15%;';
            }
            if( $i % 2 != 0) {
                $style_subject = $style_subject.'background-color: #c9c9c9;';
                $style_title = $style_title.'background-color: #c9c9c9;';
                $style_credit = $style_credit.'background-color: #c9c9c9;';
            }
            echo "<tr>";
            echo "<td style='$style_subject'>".$fyp['semester_'.$n][$i]['subject']." ".$fyp['semester_'.$n][$i]['catalog']."</td>";
            echo "<td style='$style_title'>".$fyp['semester_'.$n][$i]['title']."</td>";
            echo "<td style='$style_credit'>".$fyp['semester_'.$n][$i]['cred']."</td>";
            echo "\n";
        }
        echo "<tr></tr>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
    }
}

function displayFourYearSemester($plan, $semester_plan) {
    echo '<thead>';
        echo '<tr>';
            echo '<th>Course Number</th>';
            echo '<th>Title</th>';
            echo '<th>Credit</th>';
        echo '</tr>';
    echo '</thead>';
    for($i=0;$i<count($plan[$semester_plan]);$i++){
        echo "<tr>";
            if($i+1 == count($plan[$semester_plan])) {
                $style_subject = 'border-left: none; border-bottom: none;';
                $style_title = 'border-bottom: none;';
                $style_credit = 'border-right: none; border-bottom: none;';
            }
            else {
                $style_subject = 'border-left: none;';
                $style_title = '';
                $style_credit = 'border-right: none;';
            }
            if( $i % 2 != 0) {
                $style_subject = $style_subject.'background-color: #c9c9c9';
                $style_title = $style_title.'background-color: #c9c9c9';
                $style_credit = $style_credit.'background-color: #c9c9c9';
            }
            echo "<td style='$style_subject'>".$plan[$semester_plan][$i]['subject']." ".$plan[$semester_plan][$i]['catalog']."</td>";
            echo "<td style='$style_title'>".$plan[$semester_plan][$i]['title']."</td>";
            echo "<td style='$style_credit'>".$plan[$semester_plan][$i]['cred']."</td>";
        echo "</tr>";
    }
}

// input: list of majors
function combinedFourYear($majors) {
	$list = array();
	foreach ($majors as $m) {
		$list[] = getFourYearbyMajor($m);
	}
	echo '<script> var combined_four_year_plans = ' . json_encode( $list )  . '; </script>';
}
