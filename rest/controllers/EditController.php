<?php
namespace Rest\Controllers;

use Rest\Models\EditModel;
use Rest\Models\GetModel;

class EditController extends AbstractController
{

    protected $validatedData;
    protected $validateConfig = [
        'LABEL' => 100,
        'STREET' => 100,
        'HOUSENUMBER' => 10,
        'POSTALCODE' => 6,
        'CITY' => 100,
        'COUNTRY' => 100,
    ];

    public function edit()
    {

        if ($this->isIdExists()) {

            if ($this->isValidData()) {

                $model = new EditModel();

                $editedRows = $model->edit($this->id, $this->validatedData);
                if (!empty($editedRows)) {
                    ResponseController::sendResponse(200, 'Edited!');
                } else {
                    ResponseController::sendResponse(304, 'Nothing to change!');
                }
            } else {
                ResponseController::sendResponse(400, 'Check your data!');
            }
        } else {
            ResponseController::sendResponse(404, 'not found in DB!');
        }
    }

    protected function isIdExists()
    {
        $model = new GetModel();

        if (!empty($model->get($this->id))) {
            return true;
        }
        return false;
    }

    protected function isValidData()
    {
        $result = false;
        $data = json_decode($this->data, true);

        if (!empty($data) && is_array($data)) {

            foreach ($data as $key => $value) {
                //Check required fields and length
                if (isset($this->validateConfig[$key]) && mb_strlen($value) <= $this->validateConfig[$key]) {
                    $result = true;
                } else {
                    $result = false;
                    break;
                }
            }
        }
        if ($result) {
            $this->validatedData = $data;
        }
        return $result;
    }
}
