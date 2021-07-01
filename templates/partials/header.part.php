<?php
global $i18n;
global $lang;

$baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];

if (!isset($ogimg)) {
    $ogimg = "fallback";
}

?>
<!DOCTYPE html>
<html lang="<?= $i18n["_CODE"] ?>" style="--vh:1vh; --vw:1vw; --scpad:90px; --mcpad:90px; --lcpad:50px; --navbarHeight:80px;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <!-- Primary Meta Tags -->
    <title><?= $i18n["sitetitle"] ?><?= $subtitle ?></title>
    <meta name="title" content="<?= $i18n["sitetitle"] ?><?= $subtitle ?>">
    <meta name="description" content="<?= $i18n["og-description"] ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $baseURL ?>">
    <meta property="og:title" content="<?= $i18n["sitetitle"] ?><?= $subtitle ?>">
    <meta property="og:description" content="<?= $i18n["og-description"] ?>">
    <meta property="og:image" content="<?= $baseURL ?>/img/<?= $lang ?>/og_<?= $ogimg ?>.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $baseURL ?>">
    <meta property="twitter:title" content="<?= $i18n["sitetitle"] ?><?= $subtitle ?>">
    <meta property="twitter:description" content="<?= $i18n["og-description"] ?>">
    <meta property="twitter:image" content="<?= $baseURL ?>/img/<?= $lang ?>/og_<?= $ogimg ?>.png">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#e52b36">
    <link rel="shortcut icon" href="/img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#f5f5f5">
    <meta name="msapplication-config" content="/img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#f5f5f5">
    
    <!-- Lib Scripts -->
    <script src="/lib/jquery/jquery.min.js"></script>

    <script src="/js/style.js"></script>
    
    <!-- Lib Styles -->
    <link rel="stylesheet" href="/lib/chartist/chartist.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/style/style.css">

</head>
<body>
<div id="loader"></div>

<nav <?php (isset($lightNav)) ? print("class='lightNav'") : "" ?>>

    <div id="nav-cont" class="mdcont">
        <div id="logo-cont">
            <a href="<?php ($namespace == "home") ? print($i18n["ext-link"] . '" target="blank') : print("/") ?>" style="line-height:0"><img src="/img/<?= $i18n["_CODE"] ?>/logo.png" alt="Logo"></a>
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

<div id="main-content" class="<?= $namespace ?> <?= $i18n["_CODE"] ?>">