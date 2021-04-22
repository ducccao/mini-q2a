<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        require "./App/Views/Home/HomePage.php";
        return;
    }
}
