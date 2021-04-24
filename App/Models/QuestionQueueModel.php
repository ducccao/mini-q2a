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

    public function GetNewestQuestionQueueWithoutArrayTag()
    {
        $db = new Db();
        $sql = "SELECT  questionqueue.que_id,questionqueue.que_title , 
        questionqueue.createdAt,COUNT(*) as like_count,users.user_name
        FROM `questionqueue`
        LEFT JOIN `ratingsquestion`
        ON ratingsquestion.que_id = questionqueue.que_id 
        LEFT JOIN `users`
        ON users.user_id = questionqueue.user_id 
        WHERE ratingsquestion.rate_name = 'like'
        GROUP BY questionqueue.que_id
        ORDER BY questionqueue.createdAt;
        ";

        $db->load($sql);
        $data = $db->Rows();
        return $data;
    }


    public function GetNewstQuestionQueueArrayTagName()
    {
        $db = new Db();

        $sql = "SELECT quetionqueue_labels.que_id,labels.label_name
        FROM `quetionqueue_labels`
        LEFT JOIN `labels`
        ON labels.label_id = quetionqueue_labels.label_id;
        ";

        $db->load($sql);
        $data = $db->Rows();

        return $data;
    }
}
