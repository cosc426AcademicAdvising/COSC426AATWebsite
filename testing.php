<?php
// ob_start();
// session_start();
// require 'vendor/autoload.php';

include_once 'funcs/CourseFunctions.php';

$sub = 'COSC';
$numb = '117';
// $course = getCoursebySubCat($sub, $numb);
$course = getCourse();
print_r($course);

?>
