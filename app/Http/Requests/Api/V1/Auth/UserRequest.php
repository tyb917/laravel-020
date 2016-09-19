<?php

namespace App\Http\Requests\Api\V1\Auth;

use Dingo\Api\Http\FormRequest;

class UserRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile' => 'required|is_mobile|unique:users',
            //'mobile' => 'required|confirm_mobile_not_change|confirm_rule:check_mobile_unique',
            //'verifyCode' => 'required|verify_code',
            'password' => 'required|min:6'
        ];
    }
}
