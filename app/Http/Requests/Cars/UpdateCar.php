<?php

namespace App\Http\Requests\Cars;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateCar
 * Validates a update car request
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\
 */
class UpdateCar extends FormRequest
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
            'name'         => ['required', 'min:2', 'max:40', Rule::unique('cars')->ignore(request()->car->id)],
            'plate_number' => ['required', 'min:5', 'max:9'],
            'brand'        => ['required', 'min:2', 'max:20'],
            'model'        => ['required', 'min:2', 'max:10'],
            'color'        => ['required', 'min:2', 'max:10'],
            'status'       => ['required']
        ];
    }
}
