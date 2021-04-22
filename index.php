<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Mini social network</title>
</head>

<body>
    <div class="container">

        <!-- class DB ROOT-->

        <?php


        class Db
        {
            protected $_conn;
            protected $_ret;
            protected $_numRows;
            protected $_host = "localhost";
            protected $_username = "root";
            protected $_password = "root";
            protected $_database = "mini_social_network";

            // Establish connection to database, when class is instantiated
            public function __construct()
            {
                $this->_conn = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

                if (mysqli_connect_error()) {
                    echo "Connection failed: " . mysqli_connect_error();
                    exit();
                }
            }


            // Sends the query to the connection
            public function load($sql)
            {
                $this->_ret = $this->_conn->query($sql) or die(mysqli_error($this->_ret));
                $this->_numRows = mysqli_num_rows($this->_ret);
            }

            // patch DB
            public function patchDb($sql)
            {
                $this->_ret = $this->_conn->query($sql) or die(mysqli_error($this->_ret));
                return $this->_ret;
            }



            // Return the number of rows
            public function numRows()
            {
                return $this->_numRows;
            }
            // Fetchs the rows and return them to array
            public function Rows()
            {
                $rows = array();

                for ($i = 0; $i < $this->numRows(); $i++) {
                    $rows[] = mysqli_fetch_assoc($this->_ret);
                }
                return $rows;
            }

            // Used by other classes to get the connection
            public function getConn()
            {
                return $this->_conn;
            }

            // Securing input data
            public function secureInput($value)
            {
                return mysqli_real_escape_string($this->_conn, $value);
            }
        }

        ?>

        <!-- Init app -->

        <?php

        // Định nghĩa hằng Path của file index.php
        define('PATH_ROOT', __DIR__);

        // Autoload class trong PHP
        spl_autoload_register(function (string $class_name) {
            include_once PATH_ROOT . '/' . $class_name . '.php';
        });


        // load class Route
        $router = new Core\Route();
        include_once PATH_ROOT . '/app/routes.php';



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

        // load css Homepage
        // include "./Public";




        // Lấy url hiện tại của trang web. Mặc định la /
        $request_url = !empty($_GET['url']) ? '/' . $_GET['url'] : '/';

        // Lấy phương thức hiện tại của url đang được gọi. (GET | POST). Mặc định là GET.
        $method_url = !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

        // map URL
        $router->map($request_url, $method_url);

        // echo $request_url;
        // echo "<br/>";

        // echo $method_url;

        ?>





    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>

</html>