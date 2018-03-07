<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'firstname'     => ['required', 'min:2', 'max:100'],
            'lastname'      => ['required', 'min:2', 'max:100'],
            'email'         => ['sometimes', 'email']
            'phone_number'  => ['required', 'min:2', 'max:100'],
        ];
    }
}
