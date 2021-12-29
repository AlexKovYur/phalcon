<?php

namespace App\Exceptions;

use App\Includes\CustomLog;

class InvalidParams extends \Exception
{
    function __construct($data = 'InvalidParams') {
        parent::__construct();

        $customLog = new CustomLog();
        $customLog->addLogNotice($data);
    }
}