<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreComment
 * Validates a comment
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\Comments
 */
class StoreComment extends FormRequest
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
            'content' => ['required', 'string', 'min:2', 'max:400']
        ];
    }
}
