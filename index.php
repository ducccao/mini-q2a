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
// Use Controller & Config
// ---------------------------
use App\Controllers\QuestionQueueController;
use App\Controllers\HomeController;

require_once "./Core/Db.php";


?>







<!-- Home content  -->

<!-- Init app -->

<?php

// Định nghĩa hằng Path của file index.php
define('PATH_ROOT', __DIR__);

// Autoload class trong PHP
spl_autoload_register(function (string $class_name) {
    include_once PATH_ROOT . '/' . $class_name . '.php';
});


// Load Router
//include_once "./App/Routing.php";



GlobalConsole_log($_REQUEST);
GlobalConsole_log($_GET);
GlobalConsole_log($_SERVER);
GlobalConsole_log($_SERVER['REQUEST_URI']);

if (isset($_SERVER['REQUEST_URI'])) {
    $reqURI = $_SERVER['REQUEST_URI'];

    if ($reqURI == '/') {
        echo 'hime';
    } else {

        // ------------------
        // Routing
        // ------------------


        $action = '';
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }

        GlobalConsole_log($_GET);

        // ------------------
        // Routing By Action
        // ------------------

        GlobalConsole_log($action);



        switch ($action) {


            case 'question-queue':
                $qqController = new QuestionQueueController();


                // -------------
                // Header
                // -------------

                require_once "./App/Views/Partials/Header.php";


                echo "<body class='body'>";
                // -------------
                // Navigation Bar
                // -------------

                require_once "./App/Views/Partials/NavigationBar/NavigationBar.php";
                echo '  <div class="container">';
                // -------------
                // Search Bar
                // -------------

                require_once "./App/Views/Partials/SearchBar/SearchBar.php";
                // -------------
                // Home content
                // -------------

                $qqController->index();
                echo '</div>';
                echo   "</body>";
                // -------------
                // Footer
                // -------------

                require_once "./App/Views/Partials/Footer.php";

                echo '</html>';

                break;
            case '/':
                break;

            case 'home':
                $homeController = new HomeController();
                // -------------
                // Header
                // -------------

                require_once "./App/Views/Partials/Header.php";


                echo "<body class='body'>";
                // -------------
                // Navigation Bar
                // -------------

                require_once "./App/Views/Partials/NavigationBar/NavigationBar.php";
                echo '  <div class="container">';
                // -------------
                // Search Bar
                // -------------

                require_once "./App/Views/Partials/SearchBar/SearchBar.php";
                // -------------
                // Home content
                // -------------

                $homeController->index();
                echo '</div>';
                echo   "</body>";
                // -------------
                // Footer
                // -------------

                require_once "./App/Views/Partials/Footer.php";

                echo '</html>';

                break;

            default:
                echo "404";
                break;
        }
    }
}




?>