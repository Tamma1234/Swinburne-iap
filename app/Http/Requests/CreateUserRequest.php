<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CreateUserRequest extends FormRequest
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
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user_login' => 'User Login',
            'user_surname' => 'User Surname',
            'user_middlename' => 'User Middlename',
            'user_givenname' => 'User Givenname',
        ];
    }

    public function rules()
    {
        return [
            'user_surname' => 'required',
            'user_middlename' => 'required',
            'user_givenname' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'unique' => 'The :attributes Already exist',
            'required'=> ':attribute Không được để trống',
        ];
    }
}
