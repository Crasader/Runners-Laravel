<?php

namespace App\Http\Requests\Kiela;

use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreKielaUser
 * Validates store new user in the kielas page
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\Runs
 */
class StoreKielaUser extends FormRequest
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
            'name'       => ['required', 'string', 'exists:users,name'],
            'start_time' => ['date'],
            'end_time'   => ['date']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.exists' => "Cet utilisateur n'existe pas"
        ];
    }
}
