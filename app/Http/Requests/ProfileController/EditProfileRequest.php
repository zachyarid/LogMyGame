<?php

namespace App\Http\Requests\ProfileController;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'ussf_grade' => 'required|numeric',
            'current_password' => 'required_with_all:password,password_confirmation',
            'password' => 'required_with_all:current_password,password_confirmation|confirmed',
            'password_confirmation' => 'required_with_all:current_password,password',
            'profile_pic' => 'file|image'
        ];
    }
}
