<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public function __construct($massage)
    {
        parent::__construct($massage);
    }
}
