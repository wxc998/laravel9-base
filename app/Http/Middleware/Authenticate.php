<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse;
use App\Helpers\ResponseEnum;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    use ApiResponse;

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $this->throwBusinessException(ResponseEnum::CLIENT_HTTP_UNAUTHORIZED);
        }
    }
}
