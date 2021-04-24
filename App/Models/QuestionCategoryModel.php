<?php

namespace App\Models;

use Db;

class QuestionCategoryModel
{
    function __construct()
    {
    }

    public function GetAllQuestionCategories()
    {
        $db = new Db();

        $sql = "SELECT  questioncategories.que_cate_name, COUNT(*) AS amount
        FROM `questioncategories`
        LEFT JOIN `questionqueue`
        ON questioncategories.que_cate_id =  questionqueue.que_cate_id
        GROUP BY questioncategories.que_cate_name
        ORDER BY questioncategories.que_cate_name;
        ";

        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }
}
