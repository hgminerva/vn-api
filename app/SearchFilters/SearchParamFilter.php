<?php

namespace App\SearchFilters;

use Illuminate\Database\Eloquent\Builder;

class SearchParamFilter
{
    /**
     * This handles the "search" parameter filter.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function handle(Builder $query, $value)
    {
        return $query->orWhere('job_posting_title','like', '%' . $value . '%')
            ->orWhere('job_title','like', '%' . $value . '%')
            ->orWhere('description','like', '%' . $value . '%');
    }
}
