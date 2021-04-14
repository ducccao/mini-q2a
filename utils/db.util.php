<?php

namespace utils;

use mysqli;


class db
{

    private $hostname = 'localhost';
    private $username = 'admin';
    private $pass = "admin";
    private $dbname = 'mini_social_network';


    private $conn = null;
    private $ret = null;

    public function connect()
    {
        $this->conn = new mysqli($this->hostname, $this->username, $this->pass, $this->dbname);


        if (!$this->conn) {
            echo "Kết nối thất bại!";
            exit();
        } else {
            mysqli_set_charset($this->conn, 'utf8');
        }
        return $this->conn;
    }


    public function load($sql)
    {
        $this->ret = $this->conn->query($sql);




        return $this->ret;
    }


    public function getData()
    {
        if ($this->ret) {
            $data = mysqli_fetch_array($this->ret);
        } else {
            $data = [];
        }
        return $data;
    }

    public function getAll()
    {
        if (!$this->ret) {
            return false;
        } else {
            while ($datas = $this->getData()) {
                $datas[] = $datas;
            }
        }
        return $datas;
    }
}
