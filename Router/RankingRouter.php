
<?php

use App\Controllers\RankingController;

$rankingController = new RankingController();
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
// Home content
// -------------

$rankingController->index();
echo '</div>';
echo   "</body>";
// -------------
// Footer
// -------------

require_once "./App/Views/Partials/Footer.php";

echo '</html>';
?>