<?php

namespace App\Http\Requests\Dashboard\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleStoreRequest extends FormRequest
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
            'name'          => ['required', Rule::unique('roles', 'name')],
            'guard'         => ['required', Rule::in(array_keys(config('auth.guards')))],
            'permissions.0' => ['required', Rule::exists('permissions', 'id')],
            'permissions.*' => ['required', Rule::exists('permissions', 'id')],
        ];
    }
}
