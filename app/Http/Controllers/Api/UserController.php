<?php


namespace App\Http\Controllers\Api;


use App\Helpers\ResponseEnum;
use App\Http\Controllers\BaseController;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    /**
     * 用户注册
     * @param RegisterRequest $registerRequest
     * @return JsonResponse
     */
    public function register(RegisterRequest $registerRequest): JsonResponse
    {
        $params = $registerRequest->all('mobile', 'password');
        UserService::getInstance()->store($params);
        return $this->success(null, ResponseEnum::USER_SERVICE_REGISTER_SUCCESS);
    }

    /**
     * 用户登录
     * @param LoginRequest $loginRequest
     * @return JsonResponse
     */
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $params = $loginRequest->all('mobile', 'password');
        if (!Auth::attempt($params)) {
            return $this->fail(ResponseEnum::SERVICE_LOGIN_ACCOUNT_ERROR);
        }
        $result['user'] = User::where('mobile', $params['mobile'])->first();
        $result['token'] = $result['user']->createToken($params['mobile'], ['*'])->plainTextToken;
        return $this->success($result, ResponseEnum::USER_SERVICE_LOGIN_SUCCESS);
    }

    /**
     * 退出登录
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return $this->success(null, ResponseEnum::USER_SERVICE_LOGOUT_SUCCESS);
    }

    /**
     * 获取用户信息
     * @param Request $request
     * @return JsonResponse
     */
    public function info(Request $request): JsonResponse
    {
        return $this->success($request->user());
    }
}
