<?php
require '../vendor/autoload.php';
require '../config/config.inc.php';
global $i18n;
require "../config/i18n/{$lang}.php";
use Pecee\SimpleRouter\SimpleRouter as Router;


Router::get('/', function() {
    $subtitle = "";
    include "../templates/home.php";
});