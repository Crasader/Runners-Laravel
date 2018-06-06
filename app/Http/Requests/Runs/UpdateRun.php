<?php

namespace App\Http\Requests\Runs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateRun
 * Validates a store run request
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\Runs
 */
class UpdateRun extends FormRequest
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
            'name'                    => ['required_if:artist,', 'string', 'min:1', 'max:200'],
            'artist'                  => ['required_if:name,', 'string', 'min:1', 'max:200'],
            'planned_at'              => ['nullable', 'date'],
            'end_planned_at'          => ['nullable', 'date'],
            'waypoints.*'             => ['sometimes', 'string'],
            'subscriptions.*.user'    => ['nullable', 'string', 'exists:users,name'],
            'subscriptions.*.carType' => ['nullable', 'string', 'exists:car_types,name'],
            'subscriptions.*.car'     => ['nullable', 'string', 'exists:cars,name'],
            'add-runner'              => ['sometimes', 'in:true']
        ];
    }
}
