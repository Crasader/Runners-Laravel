<?php

namespace App\Http\Requests\CarTypes;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateCarType
 * Validates a update cartype request
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\CarTypes
 */
class UpdateCarType extends FormRequest
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
            'name' => ['required', 'min:2', 'max:30', Rule::unique('car_types')->ignore(request()->carType->id)],
            'description' => ['required', 'min:2', 'max:255'],
            'nb_place' => ['required', 'numeric', 'min:1', 'max:15']
        ];
    }
}
