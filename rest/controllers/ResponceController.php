<?php
namespace Rest\Controllers;

class ResponceController
{

    public static function sendResponce($code, $message, $body = '')
    {

        header('Content-type: application/json');
        echo json_encode([
            'code' => $code,
            'message' => $message,
            'body' => $body,
        ]);
    }
}
