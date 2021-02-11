<?php

namespace App\SearchFilters;

use Illuminate\Database\Eloquent\Builder;

class JobTypeFilter
{
    /**
     * This handles the "job_type" filter.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function handle(Builder $query, $value)
    {
        return $query->orWhere('job_type','like', '%' . $value . '%');
    }
}
