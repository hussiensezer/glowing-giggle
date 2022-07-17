<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() :bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() :array
    {
        return [
            'name'      => ['required'],
            'email'     => ['required', Rule::unique('users', 'email')],
            'password'  => ['required', Password::min(8)->symbols(), 'confirmed'],
            'status'    => ['required', 'boolean'],
            'roles'      => ['required', Rule::exists('roles', 'id')]

        ];
    }
}
