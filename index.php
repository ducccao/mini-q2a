<?php


// ---------------------------
// Required Config & Utils
// ---------------------------
require_once "./utils/utilFunction.php";
require_once "./Core/Db.php";



?>



<?php
// -----------------
// PATH ROOT
// -----------------

//$PATH_ROOT = "/mini-q2a";
//$PATH_ADMIN_ROOT = "/admin";

//$PATH_ROOT = "http://localhost:8080";
$PATH_ROOT = "http://localhost:8080/mini-q2a";
//$PATH_ADMIN_ROOT = "http://localhost:8080/admin";
// XAMPP
$PATH_ADMIN_ROOT = "http://localhost:8080/mini-q2a/admin";
$PATH_AUTO_ACCEPT_QUESTION_API_SERVICE = "http://localhost:3000/api/admin/auto-check-accept-question";

$GLOBALS['PATH_ROOT'] = $PATH_ROOT;
$GLOBALS['PATH_ADMIN_ROOT'] = $PATH_ADMIN_ROOT;
$GLOBALS['PATH_AUTO_ACCEPT_QUESTION_API_SERVICE'] = $PATH_AUTO_ACCEPT_QUESTION_API_SERVICE;



global $PATH_ROOT;

$uri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
    . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$url_len = strlen($uri);

$curr_url = '';
if (isset($_SERVER['REDIRECT_URL'])) {
    $curr_url = $_SERVER['REDIRECT_URL'];
}
$curr_route = substr($curr_url, strlen($PATH_ROOT), 100);
$curr_route = trim($curr_route);

if (isset($_SERVER['REQUEST_URI'])) {
    $curr_route = $_SERVER['REQUEST_URI'];
    $GLOBALS['curr_route'] = $curr_route;
}



?>






<!-- Require DB ROOT-->





<?php

// ---------------------------
// App Content
// ---------------------------

// Định nghĩa hằng Path của file index.php để load class
define('PATH_ROOT', __DIR__);

// Autoload class trong PHP
spl_autoload_register(function (string $class_name) {
    include_once PATH_ROOT . '/' . $class_name . '.php';
});





// ------------------
// Routing
// ------------------

if (isset($_SERVER['REQUEST_URI'])) {
    $reqURI = $_SERVER['REQUEST_URI'];
    // echo 'req url: ' . $reqURI . "<br/>";
    //console_log($reqURI);


    if (str_contains($reqURI, "/admin")) {
        // ------------------
        // route admin
        // ------------------
        require_once "./Action/AdminAction.php";
    } else if (str_contains($reqURI, "/mini-q2a")) {
        // ------------------
        // route home
        // ------------------
        require_once "./Action/HomeAction.php";
    } else if ($reqURI == '/') {
        // ------------------
        // route home
        // ------------------
        require_once "./Action/FowardSlashHomeAction.php";
    } else {
        // ------------------
        // catching  error
        // ------------------
        echo '404';
    }
}
