<?php

namespace App\Http\Requests\Users;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateUser
 * Validates a update user request
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests
 */
class UpdateUser extends FormRequest
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
            // If the name is not specified, it will be auto generated with the first and lastname
            'name'          => ['sometimes', 'nullable', 'filled', 'string', 'min:2', 'max:100'],
            'firstname'     => ['sometimes', 'string', 'min:2', 'max:100'],
            'lastname'      => ['sometimes', 'string', 'min:2', 'max:100'],
            'password'      => ['sometimes', 'string', 'confirmed', 'min:6', 'max:100'],
            'email'         => [
                'sometimes', 'string', 'email', 'max:200', Rule::unique('users')->ignore(request()->user->id)
            ],
            'phone_number'  => ['sometimes', 'min:2', 'max:100'],
            'sex'           => ['sometimes', 'filled', Rule::in(['m', 'w'])]
        ];
    }
}
