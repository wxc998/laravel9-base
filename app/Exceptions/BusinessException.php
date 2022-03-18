<?php

namespace App\Exceptions;

use Exception;

class BusinessException extends Exception
{
    /**
     * 业务异常构造函数
     * @param array $codeResponse
     * @param string $info
     */
    public function __construct(array $codeResponse, $info = '')
    {
        [$code, $message] = $codeResponse;
        parent::__construct($info ?: $message, $code);
    }
}
