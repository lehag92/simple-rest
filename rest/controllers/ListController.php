<?php
namespace Rest\Controllers;

use Rest\Models\ListModel;
class ListController
{
    public function __construct()
    {
        $list =  $this->fetchAll();
//        echo '<pre>';
//        var_dump($list);
//        die();
        ResponceController::sendResponce(200, 'OK' ,$list);
    }
    private function fetchAll()
    {$model = new ListModel();
        return $model->fetchAll();

    }
}

