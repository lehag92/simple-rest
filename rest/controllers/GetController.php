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
            ResponseController::sendResponse(200, 'OK', $item);
        } else {
            ResponseController::sendResponse(404, 'not found in DB!');
        }
    }
}
