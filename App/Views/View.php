<?php

namespace App\Views;

class View
{
    protected $data = null;


    public function render($view_path, $data)
    {
        $this->data = $data;

        require_once  $view_path;
        return;
    }
}
