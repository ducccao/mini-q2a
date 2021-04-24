<?php

namespace App\Models;

use Db;

class QuestionQueueModel
{
    public function __construct()
    {
    }

    public function getAllQuestionQueues()
    {
        $db = new Db();
        $sql = 'SELECT * FROM `questionqueue`';
        $db->load($sql);

        $questions = $db->Rows();
        return $questions;
    }
}
