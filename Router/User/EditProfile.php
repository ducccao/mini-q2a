<?php



use App\Controllers\UserController;

$userController = new UserController();
// -------------
// Header
// -------------

require_once "./App/Views/Partials/Header.php";


echo "

<body class='body'>";
// -------------
// Navigation Bar
// -------------

require_once "./App/Views/Partials/NavigationBar/NavigationBar.php";
echo ' <div class="container">';

// -------------
// Home content
// -------------

$userController->EditProfile();
echo '</div>';

// JQuery
require_once "./App/Views/Partials/JQuery/JQuery-Func.php";

echo "</body>";

// -------------
// Footer
// -------------

require_once "./App/Views/Partials/Footer.php";

echo '

</html>';
