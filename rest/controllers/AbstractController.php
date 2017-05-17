<?php
namespace Rest\Controllers;

abstract class AbstractController
{

    protected $id;
    protected $data;

    public function __construct($id, $data = '')
    {
        $this->id = (int)$id;
        $this->data = $data;
    }
}
