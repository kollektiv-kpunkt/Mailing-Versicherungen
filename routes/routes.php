<?php
require '../vendor/autoload.php';
require '../config/config.inc.php';
global $lang;
global $conn;
global $i18n;
global $config;
require "../config/i18n/{$lang}.php";
use Pecee\SimpleRouter\SimpleRouter as Router;


Router::get('/', function() {
    $subtitle = "";
    $namespace = "home";
    include "../templates/home.php";
});

Router::get($i18n["s-donate"], function() {
    global $i18n;
    $subtitle = " - {$i18n["d-title"]}";
    $namespace = "content";
    $lightNav = TRUE;
    include "../templates/donate.php";
});



// Form Submission
Router::post('/interface/{step}', function($step) {
    require "../interfaces/{$step}.php";
});

// Tests
Router::get('/tests{placeholder}', function() {
    die("You're done, dude");
});

// Router::get('/tests/email', function() {
//     require "../tests/test-email.php";
// });

use Pecee\Http\Request;
use Pecee\SimpleRouter\Handlers\IExceptionHandler;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
Router::error(function($request, $exception) {
    if($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
        header("Location: /404");
    }
});

Router::get('/404', function() {
    $subtitle = " - Not found";
    $namespace = "content";
    include "../templates/404.php";
});