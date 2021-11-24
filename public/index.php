<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/resources/getToken.php';

$token = getToken();

include_once __DIR__ . '/../app/resources/CourseFunctions.php';
include_once __DIR__ . '/../app/resources/DepartmentFunctions.php';
include_once __DIR__ . '/../app/resources/FourYearFunctions.php';
include_once __DIR__ . '/../app/resources/MinorFunctions.php';
include_once __DIR__ . '/../app/resources/StudentFunctions.php';

// namepsace wasn't working 
require_once __DIR__ . '/../app/core/Router.php';

// include everyhting in index.php so that we dont have to include in every file
// when accessing a file, index.php is always ran first

$route = new Router();

// $route->add( what the url will look like, file name)
// href('./') to reference homepage or just './'
// css and js are relative to this folder so: css/mystyle.css
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

// forms action
$route->add('/savedraft', 'savedraft');

// echo '<pre>';
// print_r($route);

// includes the file
$route->submit();
