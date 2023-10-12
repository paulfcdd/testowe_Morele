<?php

namespace App\Exception;

class InvalidCountException extends \Exception
{
    public function __construct($message = "Parameter should be greater than 0", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}