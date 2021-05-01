<?php

namespace App\Models;

use Db;

class RatingAnswerModel
{

    public function __construct()
    {
    }

    public function all()
    {
        $db = new Db();

        $sql = "SELECT *
        FROM `ratingsAnswer`;";

        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }


    public function edit()
    {
    }
    public function del()
    {
    }
    public function detail()
    {
    }

    public function allLike()
    {
        $db = new Db();

        $sql = "SELECT *
        FROM `ratingsAnswer`
        WHERE rate_name ='like';";

        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }

    public function allSpam()
    {
        $db = new Db();

        $sql = "SELECT *
        FROM `ratingsAnswer`
        WHERE rate_name ='spam';";

        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }
    public function allBadContent()
    {
        $db = new Db();

        $sql = "SELECT *
        FROM `ratingsAnswer`
        WHERE rate_name ='bad_content';";

        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }


    public function likeRatingByUserHandle($user_id, $ans_id)
    {
        $db = new Db();

        $rate_ans_id = randomString(10);

        $sql = "INSERT INTO `ratingsAnswer` (rate_ans_id, rate_name, ans_id, user_id)
        VALUES ('$rate_ans_id','like','$ans_id','$user_id');";

        $ret = $db->patchDb($sql);
        return $ret;
    }
    public function unLikeRatingByUserHandle($user_id, $ans_id)
    {
        $db = new Db();
        $sql = "DELETE 
        FROM `ratingsAnswer`
        WHERE user_id = '$user_id' 
        AND ans_id = '$ans_id'
        AND rate_name = 'like';
        ";

        $ret = $db->patchDb($sql);
        return $ret;
    }

    public function spamRatingByUserHandle($user_id, $ans_id)
    {
        $db = new Db();

        $rate_ans_id = randomString(10);

        $sql = "INSERT INTO `ratingsAnswer` (rate_ans_id, rate_name, ans_id, user_id)
        VALUES ('$rate_ans_id','spam','$ans_id','$user_id');";

        $ret = $db->patchDb($sql);
        return $ret;
    }
    public function unSpamRatingByUserHandle($user_id, $ans_id)
    {
        $db = new Db();
        $sql = "DELETE 
        FROM `ratingsAnswer`
        WHERE user_id = '$user_id' 
        AND ans_id = '$ans_id'
        AND rate_name = 'spam';
        ";

        $ret = $db->patchDb($sql);
        return $ret;
    }
    public function badContentRatingByUserHandle($user_id, $ans_id)
    {
        $db = new Db();

        $rate_ans_id = randomString(10);

        $sql = "INSERT INTO `ratingsAnswer` (rate_ans_id, rate_name, ans_id, user_id)
        VALUES ('$rate_ans_id','bad_content','$ans_id','$user_id');";

        $ret = $db->patchDb($sql);
        return $ret;
    }
    public function unBadContentRatingByUserHandle($user_id, $ans_id)
    {
        $db = new Db();
        $sql = "DELETE 
        FROM `ratingsAnswer`
        WHERE user_id = '$user_id' 
        AND ans_id = '$ans_id'
        AND rate_name = 'bad_content';
        ";

        $ret = $db->patchDb($sql);
        return $ret;
    }
}
