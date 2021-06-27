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
    include "../templates/home.php";
});

Router::post('/interface/{step}', function($step) {
    require "../interfaces/{$step}.php";
});