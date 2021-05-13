<?php


session_start();
$curr_user = '';
$isExistsUser = false;


$PATH_ROOT = $GLOBALS['PATH_ROOT'];
$curr_route = $GLOBALS['curr_route'];


if (isset($_SESSION['user_name'])) {
    $curr_user = $_SESSION['user_name'];
    $curr_user_type = $_SESSION['user_type'];

    $isExistsUser = true;
    if (isset($_SESSION['user_type'])) {
        if ($_SESSION['user_type'] != 'admin') {
            echo ("<script>location.href = '" . $PATH_ROOT . "';</script>");
        }
    }
} else {
    echo ("<script>location.href = '" . $PATH_ROOT . "';</script>");
}
console_log($curr_user . ' is loged-in in system');
console_log('User type is: ' . $curr_user_type);



?>



<?php

use App\Controllers\AdminController;

$adController = new AdminController();


echo "<html lang='en'>";
// -------------
// Header
// -------------

require_once "./App/Views/Admin/partials/Header.php";


echo '<body>';


echo '<div class="q2a-wrapper">';
// -------------
// side bar
// -------------

include_once "./App/Views/Admin/partials/Sidebar.php";


// -------------
// Admin Content
// -------------

echo '<div class="q2a-content">';
// -------------
// Nav 
// -------------
include_once "./App/Views/Admin/partials/Navbar.php";

echo '<div class="q2a-content-content">';

// -----------------------
// Content right there
// -----------------------
$adController->AllQuestionToAddLabel();



echo '</div>';


echo '</div>';


echo '</div>';

// JQuery
require_once "./App/Views/Partials/JQuery/JQuery-Func.php";

echo '</body>';

// -------------
// Footer
// -------------

require_once "./App/Views/Admin/partials/Footer.php";

echo "</html>";
