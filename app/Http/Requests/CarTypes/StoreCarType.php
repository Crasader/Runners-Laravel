<?php

namespace App\Http\Requests\CarTypes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreCarType
 * Validates a store cartype request
 *
 * @author Nicolas Henry
 * @package App\Http\Requests\CarTypes
 */
class StoreCarType extends FormRequest
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
            'name' => ['required', 'min:2', 'max:30', 'unique:car_types'],
            'description' => ['required', 'min:2', 'max:255'],
            'nb_place' => ['required', 'numeric', 'min:1', 'max:15']
        ];
    }
}
