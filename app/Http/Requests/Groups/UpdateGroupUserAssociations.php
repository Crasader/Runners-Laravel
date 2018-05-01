<?php

namespace App\Http\Requests\Groups;

use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateGroupUserAssociations
 *
 * This request validates the group manager subission
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\Groups
 */
class UpdateGroupUserAssociations extends FormRequest
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
            'user.*' => ['numeric', 'exists:groups,id']
        ];
    }
}
