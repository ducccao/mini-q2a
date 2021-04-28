<?php

use App\Controllers\QuestionQueueController;

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

// JQuery
require_once "./App/Views/Partials/JQuery/JQuery-Func.php";

echo   "</body>";
// -------------
// Footer
// -------------

require_once "./App/Views/Partials/Footer.php";

echo '</html>';
