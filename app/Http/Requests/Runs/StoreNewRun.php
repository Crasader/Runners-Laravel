<?php

namespace App\Http\Requests\Runs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreNewRun
 * Validates a store run request
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\Runs
 */
class StoreNewRun extends FormRequest
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
            'name'                     => ['required_if:artist,', 'string', 'min:1', 'max:200'],
            'artist'                  => ['required_if:name,', 'string', 'min:1', 'max:200'],
            'planned_at'              => ['nullable', 'date'],
            'tbc'                     => ['nullable', 'integer'],
            'end_planned_at'          => ['nullable', 'date'],
            'waypoints.*'             => ['sometimes', 'string'],
            'subscriptions.*.user'    => ['sometimes', 'string', 'exists:users,name'],
            'subscriptions.*.carType' => ['sometimes', 'string', 'exists:car_types,name'],
            'subscriptions.*.car'     => ['sometimes', 'string', 'exists:cars,name']
        ];
    }
}
