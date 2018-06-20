<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * AssociateNewCarToRunSubscription
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\
 */
class AssociateNewCarToRunSubscription extends FormRequest
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
            'car_id' => ['required', 'exists:cars,id']
        ];
    }
}