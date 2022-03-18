<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{
    protected $mobile;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [];
        switch($this->method())
        {
            case "POST" :
                $rules = [
                    'mobile'   => 'required|unique:users|regex:/^1[^0-2]\d{9}$/',
                    'password' => 'required|string|min:6|max:20',
                ];
        }
        return $rules;
    }

    /**
     * 获取验证错误的自定义属性。
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'mobile'   => '手机号',
            'password' => '密码',
        ];
    }


    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'mobile.required' => '请输入手机号',
            'password.required' => '请输入密码',
        ];
    }
}
