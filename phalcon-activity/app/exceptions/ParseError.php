<?php

namespace App\Exceptions;

use App\Includes\CustomLog;

class ParseError extends \Exception
{
    function __construct($data = 'ParseError') {
        parent::__construct();

        $customLog = new CustomLog();
        $customLog->addLogError($data);
    }
}