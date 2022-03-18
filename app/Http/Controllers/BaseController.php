<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\VerifyRequestInput;

class BaseController extends Controller
{
    // API接口响应
    use ApiResponse;

    // 验证表单参数输入请求
    use VerifyRequestInput;

    /**
     * Get the token array structure.
     * @param string $token
     * @return string
     */
    protected function respondWithToken(string $token): string
    {
        return 'Bearer '.$token;
    }
}
