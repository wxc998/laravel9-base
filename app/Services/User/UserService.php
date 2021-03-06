<?php


namespace App\Services\User;


use App\Helpers\ResponseEnum;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService
{
    // 存储用户信息
    public function store(array $params)
    {
        $user = User::query()->create([
            'mobile' => $params['mobile'],
            'password' => bcrypt($params['password']),
        ]);
        if (!$user){
            $this->throwBusinessException(ResponseEnum::USER_SERVICE_REGISTER_ERROR);
        }
    }

    // 获取用户信息
    public function info(array $user)
    {

        return ['id' => 1, 'nickname' => '张三', 'age' => 18];
    }

}
