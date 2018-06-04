<?php

namespace App\Extensions\Filters;

/**
 * Filterable
 *
 * Provides additional methods to the model to filter requests
 * Intended to be use with the filterable component
 *
 * @author Bastien Nicoud
 * @package App\Extensions\Filters
 */
trait Filterable
{
    /**
     * scopeFilter
     * Attach the right scopes to the query depending the filters required
     * This method is just a facade for the 4 scopes below
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $request)
    {
        // Add's diferents scopes depending the query string (GET request)
        if ($request->query('filter')) {
            $query->filterValue($request);
        }
        if ($request->query('search')) {
            $query->filterSearch($request);
        }
        if ($request->query('order')) {
            $query->filterOrder($request);
        }
        return $query;
    }

    /**
     * filterValue
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterValue($query, $request)
    {
        $query->whereIn($request->query('filter-column'), $request->query('filter'));
    }

    /**
     * filterSearch
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterSearch($query, $request)
    {
        $columnName = $request->query('search');
        return $query->whereRaw("LOWER(`$columnName`) LIKE ? ", [trim(strtolower($request->query('needle'))).'%']);
    }

    /**
     * filterOrder
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterOrder($query, $request)
    {
        $query->orderBy($request->query('order'), $request->query('direction'));
    }
}
