<?php

namespace App\Includes;

use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;

class CustomLog
{
   public function addLogInfo($data = 'LogInfo')
   {
       $adapter = new Stream(APP_PATH . '/logs/application.log');
       $logger  = new Logger(
           'messages',
           [
               'main' => $adapter,
           ]
       );

       $logger->info($data);
   }

    public function addLogNotice($data = 'InvalidRequest')
    {
        $adapter = new Stream(APP_PATH . '/logs/request.log');
        $logger  = new Logger(
            'messages',
            [
                'main' => $adapter,
            ]
        );

        $logger->notice($data);
    }

    public function addLogError($data = 'MethodNotFound')
    {
        $adapter = new Stream(APP_PATH . '/logs/method.log');
        $logger  = new Logger(
            'messages',
            [
                'main' => $adapter,
            ]
        );

        $logger->error($data);
    }
}