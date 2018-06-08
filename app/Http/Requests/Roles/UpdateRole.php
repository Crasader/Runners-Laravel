<?php

namespace App\Http\Requests\Roles;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateRole
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\Roles
 */
class UpdateRole extends FormRequest
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
            'slug' => [
                'required',
                'string',
                'max:50',
                // The regex is used to validate the slug format
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('roles')->ignore(request()->role->id)
            ],
            'name' => ['required', 'string', 'max:50'],
            'permissions.*' => [Rule::in(['true', 'false'])]
        ];
    }
}
