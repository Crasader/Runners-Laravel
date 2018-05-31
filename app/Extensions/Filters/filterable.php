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
            $query = this.filterValue($query, $request);
        }
        if ($request->query('search')) {
            $query = this.filterSearch($query, $request);
        }
        if ($request->query('order')) {
            $query = this.filterOrder($query, $request);
        }
        if ($request->query('between')) {
            $query = this.filterBetween($query, $request);
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
    public function filterValue($query, $request)
    {
        //
    }

    /**
     * filterSearch
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filterSearch($query, $request)
    {
        //
    }

    /**
     * filterOrder
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filterOrder($query, $request)
    {
        //
    }

    /**
     * filterBetween
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filterBetween($query, $request)
    {
        //
    }
}
