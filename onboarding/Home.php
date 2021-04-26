<!-- ------------------- -->
<!-- Home Router Content -->
<!-- ------------------- -->
<?php
// PATH ROOT
$PATH_ROOT = "/mini-q2a";
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
console_log($curr_route);

?>



<!-- Init app -->

<?php
// Header
require_once "./App/Views/Partials/Header.php";

// Navigation Bar 
require_once "./App/Views/Partials/NavigationBar/NavigationBar.php";


// Require DB ROOT
require_once "./Core/Db.php";

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



// Định nghĩa hằng Path của file index.php
define('PATH_ROOT', __DIR__);

// Autoload class trong PHP
spl_autoload_register(function (string $class_name) {
    include_once PATH_ROOT . '/' . $class_name . '.php';
});

// Home content
// Load Router
echo "<body class='body'>";
echo "<div class='container'>";
// Search Bar 
require_once "./App/Views/Partials/SearchBar/SearchBar.php";

// Home router Content - by controller
include_once "./router/HomeRouter.php";
echo " </div>";
// Footer
require_once "./App/Views/Partials/Footer.php";

echo "</body>";
echo '</html>';



?>
<!-- ------------------- -->
<!-- End Home Router Content -->
<!-- ------------------- -->