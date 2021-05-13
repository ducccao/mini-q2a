<?php

namespace App\Controllers;

use App\Views\View;

class RankingController
{
    public function index()
    {
        $view_path = "./App/Views/Ranking/Ranking.php";
        $data = [];
        $ranking_view = new View();
        return $ranking_view->render($view_path, $data);
    }
}
