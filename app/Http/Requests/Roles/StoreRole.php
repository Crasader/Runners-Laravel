<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use App\Role;
use Illuminate\Support\Facades\Auth;

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
            'slug' => [],
            'name' => [],
            'permission.*' => []
        ];
    }
}
