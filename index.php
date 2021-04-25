<!-- Header -->

<?php
require_once "./App/Views/Partials/Header.php";
?>

<!-- PATH ROOT -->

<?php
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

<body class="body">

    <!-- Navigation Bar -->
    <?php
    require_once "./App/Views/Partials/NavigationBar/NavigationBar.php";
    ?>


    <div class="container">

        <!-- Require DB ROOT-->

        <?php
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

        ?>



        <!-- Search Bar -->
        <?php
        require_once "./App/Views/Partials/SearchBar/SearchBar.php";
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
        include_once "./App/Routing.php";






        // Lấy url hiện tại của trang web. Mặc định la /
        // $request_url = !empty($_GET['url']) ? '/' . $_GET['url'] : '/';

        // // Lấy phương thức hiện tại của url đang được gọi. (GET | POST). Mặc định là GET.
        // $method_url = !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

        // map URL
        // $router->map($request_url, $method_url);

        // echo $request_url;
        // echo "<br/>";

        // echo $method_url;

        ?>



    </div>

    <!-- Footer -->
    <?php
    require_once "./App/Views/Partials/Footer.php";
    ?>
</body>

</html>