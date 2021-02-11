<?php

namespace App\SearchFilters;

use Illuminate\Database\Eloquent\Builder;

class AreaFilter
{
    /**
     * This handles the "area" filter.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function handle(Builder $query, $value)
    {
        return $query->orWhere('area','like', '%' . $value . '%');
    }
}
