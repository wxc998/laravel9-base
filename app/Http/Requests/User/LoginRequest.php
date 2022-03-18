<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'mobile' => 'required|regex:/^1[^0-2]\d{9}$/|exists:App\Models\User,mobile',
            'password' => 'required|string|min:6|max:20',
        ];
    }

    /**
     * 获取验证错误的自定义属性。
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'mobile' => '手机号',
            'password' => '密码',
        ];
    }


    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mobile.require' => '请输入手机号',
            'password.require' => '请输入密码',
        ];
    }
}
