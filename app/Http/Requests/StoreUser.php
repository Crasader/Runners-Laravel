<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * StoreUser
 * Validates a store user request
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests
 */
class StoreUser extends FormRequest
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
            'name'          => ['sometimes', 'filled', 'string', 'min:2', 'max:100'],
            'firstname'     => ['required', 'string', 'min:2', 'max:100'],
            'lastname'      => ['required', 'string', 'min:2', 'max:100'],
            'password'      => ['required', 'string', 'confirmed', 'min:6', 'max:100'],
            'email'         => ['required', 'string', 'email', 'max:200', 'unique:users'],
            'phone_number'  => ['required', 'min:2', 'max:100'],
            'sex'           => ['sometimes', 'filled', Rule::in(['m', 'w'])]
        ];
    }
}
