<?php

namespace App\Http\Requests\Roles;

use App\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreRole
 *
 * @author Bastien Nicoud
 * @package App\Http\Requests\Roles
 */
class StoreRole extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('create', Role::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // The regex is used to validate the slug format
            'slug' => ['required', 'string', 'max:50', 'unique:roles', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'name' => ['required', 'string', 'max:50'],
            'permissions.*' => [Rule::in(['true', 'false'])]
        ];
    }
}
