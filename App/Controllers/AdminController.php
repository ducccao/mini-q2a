<?php

namespace App\Controllers;

class AdminController
{
    public function index()
    {
        require "./App/Views/Admin/vwIndex/index.php";
        return;
    }
    public function GetPostControlPage()
    {
        require "./App/Views/Admin/vwPostControl/PostControl.php";
        return;
    }
}
