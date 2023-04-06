<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupMemberRequest extends FormRequest
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
            'student_name' => 'Member Login',

        ];
    }

    public function rules()
    {
        return [
            'student_name' => 'unique:fu_group_member,member_login',
        ];
    }

    public function messages()
    {
        return [
            'unique' => 'The :attributes Already exist'
        ];
    }
}
