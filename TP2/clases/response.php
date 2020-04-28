<?php

namespace response;

class Response{
    public $status;
    public $data;

    public function __construct()
    {
        $this->status = 'success';
         $this->data=array();
    }
}
?>