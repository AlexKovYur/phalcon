<?php

namespace App\Exceptions;

use App\Includes\CustomLog;

class InvalidRequest extends \Exception
{
    function __construct($data = 'InvalidRequest') {
        parent::__construct();

        $customLog = new CustomLog();
        $customLog->addLogNotice($data);
    }
}