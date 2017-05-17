<?php
namespace Rest\Controllers;

use Rest\Models\GetModel;

class GetController extends AbstractController
{

    public function get()
    {
        $model = new GetModel();

        $item = $model->get($this->id);
        if (!empty($item)) {
            ResponceController::sendResponce(200, 'OK', $item);
        } else {
            ResponceController::sendResponce(404, 'not found in DB!');
        }
    }
}
