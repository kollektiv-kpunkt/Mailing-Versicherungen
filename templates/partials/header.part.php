<?php
global $i18n
?>
<!DOCTYPE html>
<html lang="<?= $i18n["_CODE"] ?>" style="--vh:1vh; --vw:1vw; --scpad:90px; --mcpad:90px; --lcpad:50px; --navbarHeight:80px;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title><?= $i18n["sitetitle"] ?><?= $subtitle ?></title>
    
    <!-- Lib Styles -->
    <link rel="stylesheet" href="/lib/chartist/chartist.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/style/style.css">

    <!-- Lib Scripts -->
    <script src="/lib/jquery/jquery.min.js"></script>

    <script src="/js/style.js"></script>
</head>
<body>

<nav>

    <div id="nav-cont" class="mdcont">
        <div id="logo-cont">
            <img src="/img/<?= $i18n["_CODE"] ?>/logo.png" alt="Logo">
            <div id="logo-text-cont">
                <span id="logo-title"><?= $i18n["logo-title"] ?></span><br>
                <span id="logo-subtitle"><?= $i18n["logo-subtitle"] ?></span>
            </div>
        </div>
        <div id="menu-cont">
            <span id="menu-title">Menu</span>
            <div id="menu-tofuburger">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

</nav>

<div id="main-content">