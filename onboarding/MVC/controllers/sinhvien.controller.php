<?php

class SinhVienController
{

    public function listAll()
    {
        $data = SinhVienModel::listAll();
        require_once "./onboarding/MVC/views/vwSinhVien_ListAll.php";
    }

    public function search($keyword)
    {
        $data = SinhVienModel::find($keyword);
        // require("./onboarding/MVC/views/vwSinhVien_ListAll.php");
    }
}
