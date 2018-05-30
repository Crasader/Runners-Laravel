<?php

namespace App\Extensions\Filters;

/**
 * Filterable
 *
 * Provides additional methods to the model to filter requests
 *
 * @author Bastien Nicoud
 * @package App\Extensions\Filters
 */
trait Filterable
{
    /**
     * scopeFilter
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $request)
    {
        dd($request->query());
    }

    /**
     * scopeFilterOrder
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterOrder($query, $request)
    {
        # Code ...
    }
}
