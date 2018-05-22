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
            //
        ];
    }
}
