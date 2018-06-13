<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\User;

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
        return Auth::user()->can('create', User::class);
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
            'name'          => ['nullable', 'string', 'min:2', 'max:100'],
            'firstname'     => ['required', 'string', 'min:2', 'max:100'],
            'lastname'      => ['required', 'string', 'min:2', 'max:100'],
            'email'         => ['required', 'string', 'email', 'max:200', 'unique:users'],
            'phone_number'  => ['required', 'min:2', 'max:100'],
            'sex'           => ['required', 'filled', Rule::in(['m', 'w'])],
            'role'          => ['required', 'exists:roles,slug', new Can('associate', Role::class)],
            'status'        => ['required', 'exists:statuses,slug', new Can('associate', Status::class)]
        ];
    }
}
