<?php

namespace App\Models;

use Db;

class RatingQuestionModel
{

    public function __construct()
    {
    }

    public function all()
    {
        $db = new Db();

        $sql = "SELECT *
        FROM `ratingsquestion`;";

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
        FROM `ratingsquestion`
        WHERE rate_name ='like';";

        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }

    public function allSpam()
    {
        $db = new Db();

        $sql = "SELECT *
        FROM `ratingsquestion`
        WHERE rate_name ='spam';";

        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }
    public function allBadContent()
    {
        $db = new Db();

        $sql = "SELECT *
        FROM `ratingsquestion`
        WHERE rate_name ='bad_content';";

        $db->load($sql);
        $ret = $db->Rows();
        return $ret;
    }


    public function likeRatingByUserHandle($user_id, $que_id)
    {
        $db = new Db();

        $rate_id = randomString(10);

        $sql = "INSERT INTO `ratingsquestion` (rate_id, rate_name, que_id, user_id)
        VALUES ('$rate_id','like','$que_id','$user_id');";

        $ret = $db->patchDb($sql);
        return $ret;
    }
    public function unLikeRatingByUserHandle($user_id, $que_id)
    {
        $db = new Db();
        $sql = "DELETE 
        FROM `ratingsquestion`
        WHERE user_id = '$user_id' 
        AND que_id = '$que_id'
        AND rate_name = 'like';
        ";

        $ret = $db->patchDb($sql);
        return $ret;
    }

    public function spamRatingByUserHandle($user_id, $que_id)
    {
        $db = new Db();

        $rate_id = randomString(10);

        $sql = "INSERT INTO `ratingsquestion` (rate_id, rate_name, que_id, user_id)
        VALUES ('$rate_id','spam','$que_id','$user_id');";

        $ret = $db->patchDb($sql);
        return $ret;
    }
    public function unSpamRatingByUserHandle($user_id, $que_id)
    {
        $db = new Db();
        $sql = "DELETE 
        FROM `ratingsquestion`
        WHERE user_id = '$user_id' 
        AND que_id = '$que_id'
        AND rate_name = 'spam';
        ";

        $ret = $db->patchDb($sql);
        return $ret;
    }
    public function badContentRatingByUserHandle($user_id, $que_id)
    {
        $db = new Db();

        $rate_id = randomString(10);

        $sql = "INSERT INTO `ratingsquestion` (rate_id, rate_name, que_id, user_id)
        VALUES ('$rate_id','bad_content','$que_id','$user_id');";

        $ret = $db->patchDb($sql);
        return $ret;
    }
    public function unBadContentRatingByUserHandle($user_id, $que_id)
    {
        $db = new Db();
        $sql = "DELETE 
        FROM `ratingsquestion`
        WHERE user_id = '$user_id' 
        AND que_id = '$que_id'
        AND rate_name = 'bad_content';
        ";

        $ret = $db->patchDb($sql);
        return $ret;
    }
}
