<?php

namespace AppBundle\Exception;

/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/12/2018
 * Time: 3:53 PM
 */
class ApiException extends \Exception
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getErrorDetails()
    {
        return [
            'code' => $this->getCode() ?: 404,
            'message' => $this->getMessage() ?: 'API Exception',
        ];
    }
}