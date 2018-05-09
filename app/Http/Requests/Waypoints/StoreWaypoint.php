<?php

namespace App\Http\Requests\Waypoints;

use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreWaypoint
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\Waypoints
 */
class StoreWaypoint extends FormRequest
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
            'name' => ['required', 'string', 'min:1', 'max:200']
        ];
    }
}
