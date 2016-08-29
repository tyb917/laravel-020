<?php

namespace App\Http\Requests\Backend\Access\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreOrUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //return role('root');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|alpha_dash_upr_first',
            'display_name' => 'required',
            'description' => 'required',
            'sort' => 'required',
        ];
    }

}
