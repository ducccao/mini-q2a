
<?php


use models\UserModel;
use controllers\UserController;
use Route;

$router = new Route;
$router->get("/onboarding/sumGET.php", function () {
});



$router->get("/", function () {

    echo "<br/>";
    echo "  <a href='/onboarding/sumGET/sumGETClient.html'>sum GET</a>";
    echo "<br/>";
    echo " <a href='/onboarding/sumPOST/sumPOSTClient.html'>sum POST</a>";
    echo "<br/>";
    echo " <a href='/onboarding/GetOrPost/GetOrPost.html'>GET or POST</a>";
    echo "<br/>";
    echo " <a href='/users'>CRUD Student</a>";
});


$router->get("/users", function () {
});
