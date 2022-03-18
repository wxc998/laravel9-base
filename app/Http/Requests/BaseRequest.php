<?php

namespace App\Http\Requests;

use App\Exceptions\BusinessException;
use App\Helpers\ApiResponse;
use App\Helpers\ResponseEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    use ApiResponse;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @throws BusinessException
     */
    protected function failedValidation(Validator $validator)
    {
        $errorMsg = $validator->errors()->first();
        // 将空格和句号替换成空
        $info = str_replace([' ', '。'],'',$errorMsg);
        $this->throwBusinessException(ResponseEnum::CLIENT_PARAMETER_ERROR, $info);
    }
}
