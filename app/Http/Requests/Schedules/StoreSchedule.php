<?php

namespace App\Http\Requests\Schedules;

use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreSchedule
 * Validates a store schedule request
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\Schedules
 */
class StoreSchedule extends FormRequest
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
            'group_id'   => ['required', 'integer'],
            'start_time' => ['required', 'date'],
            'end_time'   => ['required', 'date', 'gt:start_time']
        ];
    }
}
