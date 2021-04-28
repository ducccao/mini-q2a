<?php
// -----------------
// PATH ROOT
// -----------------

//$PATH_ROOT = "/mini-q2a";
$PATH_ROOT = "http://localhost:1212";
$GLOBALS['PATH_ROOT'] = $PATH_ROOT;

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


// load console log util
function  console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
function GlobalConsole_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}


// ---------------------------
// Required Config
// ---------------------------

require_once "./Core/Db.php";


?>






<?php

// Định nghĩa hằng Path của file index.php để load class
define('PATH_ROOT', __DIR__);

// Autoload class trong PHP
spl_autoload_register(function (string $class_name) {
    include_once PATH_ROOT . '/' . $class_name . '.php';
});




if (isset($_SERVER['REQUEST_URI'])) {
    $reqURI = $_SERVER['REQUEST_URI'];

    if ($reqURI == '/') {
        require_once "./Router/HomeRouter.php";
    } else {

        // ------------------
        // Routing
        // ------------------


        $action = '';
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }



        // ------------------
        // Routing By Action
        // ------------------


        switch ($action) {
            case 'question-queue':
                require_once "./Router/QuestionQueueRouter.php";
                break;
            case 'home':
                require_once "./Router/HomeRouter.php";
                break;
            case 'ranking':
                require_once "./Router/RankingRouter.php";
                break;
            case 'user-login':
                require_once "./Router/UserLoginRouter.php";
                break;

            case 'user-register':
                require_once "./Router/UserRegisterRouter.php";

                break;
            case 'admin':
                require_once "./Router/AdminPageRouter.php";
                break;

            default:
                echo "404";
                break;
        }
    }
}




?>