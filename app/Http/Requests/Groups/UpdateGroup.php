<?php

namespace App\Http\Requests\Groups;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateGroup
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\Groups
 */
class UpdateGroup extends FormRequest
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
            'name'  => ['required', 'string', 'min:1', 'max:50', Rule::unique('groups')->ignore(request()->group->id)],
            'color' => ['required', 'string', 'min:6', 'max:6', 'regex:/^([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
        ];
    }
}
