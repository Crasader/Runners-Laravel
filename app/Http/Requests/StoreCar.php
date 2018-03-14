<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreCar
 * Validates a store car request
 *
 * @author Nicolas Henry
 * @package App\Http\Requests\
 */
class StoreCar extends FormRequest
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
            'plate_number' => ['required', 'min:9', 'max:9'],
            'brand'        => ['required', 'min:2', 'max:20'],
            'model'        => ['required', 'min:2', 'max:10'],
            'color'        => ['required', 'min:2', 'max:10'],
            'type_id'      => ['required', 'integer']
        ];
    }
}
