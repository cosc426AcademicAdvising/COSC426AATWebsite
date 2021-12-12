<?php

require_once 'vendor/autoload.php';
require_once 'app/resources/getToken.php';


include_once 'app/resources/CourseFunctions.php';
include_once 'app/resources/DepartmentFunctions.php';
include_once 'app/resources/FourYearFunctions.php';
include_once 'app/resources/MinorFunctions.php';
include_once 'app/resources/StudentFunctions.php';

// namepsace wasn't working 
require_once 'app/core/Router.php';

// include everyhting in index.php so that we dont have to include in every file
// when accessing a file, index.php is always ran first

$route = new Router();

// $route->add( what the url will look like, file name)
// to reference homepage: './'
// to include css, js, img: public/css/mystyle.css
// $route->add('', '');

$route->add('/', 'login');
$route->add('/signout', 'signout');

$route->add('/dashboard', 'dashboard');
$route->add('/programplanningworksheet', 'newSchedule');
$route->add('/viewschedule', 'viewSchedule');
$route->add('/majorplan', 'majorPlan');
$route->add('/minorplan', 'minorPlan');
$route->add('/coursehistory', 'courseHistory');
$route->add('/contact', 'info');
$route->add('/newuser', 'newUser');
$route->add('/firsttime', 'firstTimeForm');
$route->add('/submitfirsttime', 'submitFirstTime');

// forms action
$route->add('/savedraft', 'savedraft');
$route->add('/submitPPW', 'submitPPW');

// echo '<pre>';
// print_r($route);

// includes the file
$route->submit();
