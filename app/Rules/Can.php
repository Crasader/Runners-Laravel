<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

/**
 * Can
 * Chek if the authenticated user can edit this type of datas.
 * Used for forms that makes updates in other cruds than his base crud
 *
 * @author Bastien Nicoud
 * @package App\Rules
 */
class Can implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @return void
     */
    public function __construct(string $action, string $model)
    {
        $this->action = $action;
        $this->model  = $model;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Auth::user()->can($this->action, $this->model);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.uppercase');
    }
}
