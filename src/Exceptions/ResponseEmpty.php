<?php

namespace MiguelGarces\ConsultasRues\Exceptions;

use Exception;

class ResponseEmpty extends Exception {

    public $response;

    public function __construct($message, $response)
    {
        $this->response = $response;
        parent::__construct($message);
    }

}