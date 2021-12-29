<?php

namespace App\Exceptions;

use App\Includes\CustomLog;

class MethodNotFound extends \Exception
{
    function __construct($data = 'MethodNotFound') {
        parent::__construct();

        $customLog = new CustomLog();
        $customLog->addLogError($data);
    }
}