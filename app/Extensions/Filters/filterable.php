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
        if ($request->query('filter')) {
            $filters = collect($request->query('filters'));
            $filters->each(function ($filter) {
                // ...
            });
            // return $query->where($filter);
        }
        return $query;
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
        if ($request->query('orderby')) {
            return $query;
        }
        return $query;
    }

    /**
     * scopeFilterBetween
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterBetween($query, $request)
    {
        if ($request->query('between')) {
            return $query;
        }
        return $query;
    }
}
