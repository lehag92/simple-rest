<?php
namespace Rest\Controllers;

class ResponseController
{

    public static function sendResponse($code, $message, $body = '')
    {

        header('Content-type: application/json');
        echo json_encode([
            'code' => $code,
            'message' => $message,
            'body' => $body,
        ]);
    }
}
