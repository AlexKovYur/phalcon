<?php

namespace App\Controllers\JsonRPC;

use App\Exceptions\ParseError;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;

class Request
{
    /**
     * Request id
     * @var string|int|null
     */
    public $id;

    /**
     * Request version
     * @var string
     */
    public $version;

    /**
     * Method
     * @var string
     */
    public $method;

    /**
     * Parameters
     * @var array
     */
    public $params = [];

    /**
     * Creates request object from string
     * @param string $string
     * @return JsonRPC\Request
     */
    public static function fromString($string)
    {
        //$string = '{"jsonrpc":"2.0","id":1,"method":"index.index","params":[]}';
        $adapter = new Stream(APP_PATH . '/logs/application.log');
        $logger  = new Logger(
            'messages',
            [
                'main' => $adapter,
            ]
        );

        //$logger->info($string);

        // Check that request is not empty
        if (empty($string)) {
            //throw new Exception\InvalidRequest('Given request is empty');
            throw new ParseError('Given request is empty');
        }

        // Decode given string
        $data = json_decode($string, true);

        // If there is parse error, throw exception
        if (json_last_error() !== JSON_ERROR_NONE) {
            switch (json_last_error()) {
                case JSON_ERROR_DEPTH:
                    $message = 'Maximum stack depth exceeded';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    $message = 'Underflow or the modes mismatch';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    $message = 'Unexpected control character found';
                    break;
                case JSON_ERROR_SYNTAX:
                    $message = 'Syntax error, malformed JSON';
                    break;
                case JSON_ERROR_UTF8:
                    $message = 'Malformed UTF-8 characters, possibly incorrectly encoded';
                    break;
                default:
                    $message = 'Unknown parsing error';
                    break;
            }
            throw new ParseError($message);
        }

        // Set up version
        if ($data['jsonrpc'] !== '2.0') {
            //throw new Exception\InvalidRequest('Incorrect JSON-RPC version');
            throw new ParseError('Incorrect JSON-RPC version');
        }

        // If there is no ID, throw exception
        if (empty($data['id'])) {
            //throw new Exception\InvalidRequest('ID is incorrect');
            throw new ParseError('ID is incorrect');
        }

        // If there is no method, throw exception
        if (empty($data['method'])) {
            //throw new Exception\MethodNotFound('Method can not be empty');
            throw new ParseError('Method can not be empty');
        }

        // If threre is no params, throw exception
        if (!isset($data['params'])) {
            //throw new Exception\InvalidParams('Params are not specified');
            throw new ParseError('Params are not specified');
        }

        // Create and fill in jsonrpc request
        $request = new self();
        $request->version = $data['jsonrpc'];
        $request->id      = $data['id'];
        $request->method  = $data['method'];
        $request->params  = $data['params'];

        return $request;
    }
}