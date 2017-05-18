<?php
namespace Rest\Controllers;

use Rest\Models\ListModel;

class ListController
{

    public function __construct()
    {
        $list = $this->fetchAll();
        ResponseController::sendResponse(200, 'OK', $list);
    }

    private function fetchAll()
    {
        $model = new ListModel();

        return $model->fetchAll();
    }
}
