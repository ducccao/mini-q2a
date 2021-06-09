<?php

namespace App\Controllers;

use App\Models\RankingModel;
use App\Views\View;

class RankingController
{
    public function index()
    {
        $view_path = "./App/Views/Ranking/Ranking.php";


        $rankingModel = new RankingModel();
        $dataRanking = $rankingModel->all();


        for ($i = 0; $i < count($dataRanking); ++$i) {

            if ((int)$dataRanking[$i]['queMonth'] == 0) {
                if ((int) $dataRanking[$i]['total_count_ranking'] >= 9) {
                    $dataRanking[$i]['total_count_ranking'] = "Kim Cương";
                } else if (
                    (int) $dataRanking[$i]['total_count_ranking'] >= 5
                    && (int) $dataRanking[$i]['total_count_ranking'] < 9
                ) {
                    $dataRanking[$i]['total_count_ranking'] = "Vàng";
                } else if (
                    (int) $dataRanking[$i]['total_count_ranking'] < 5
                    && (int) $dataRanking[$i]['total_count_ranking'] > 0
                ) {
                    $dataRanking[$i]['total_count_ranking'] = "Bạc";
                } else if ((int) $dataRanking[$i]['total_count_ranking'] == 0) {
                    $dataRanking[$i]['total_count_ranking'] = "Đồng";
                }
            } else {
                if ((int) $dataRanking[$i]['total_count_ranking'] >= 9) {
                    $dataRanking[$i]['total_count_ranking'] = "Kim Cương";
                } else if (
                    (int) $dataRanking[$i]['total_count_ranking'] >= 5
                    && (int) $dataRanking[$i]['total_count_ranking'] < 9
                ) {
                    $dataRanking[$i]['total_count_ranking'] = "Vàng";
                } else if (
                    (int) $dataRanking[$i]['total_count_ranking'] < 5
                    && (int) $dataRanking[$i]['total_count_ranking'] > 0
                ) {
                    $dataRanking[$i]['total_count_ranking'] = "Bạc";
                } else if ((int) $dataRanking[$i]['total_count_ranking'] == 0) {
                    $dataRanking[$i]['total_count_ranking'] = "Đồng";
                }
            }
        }


        $data = [$dataRanking];


        $ranking_view = new View();
        return $ranking_view->render($view_path, $data);
    }
}
