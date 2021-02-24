<?php

namespace App\SearchFilters;

use Illuminate\Database\Eloquent\Builder;

class SearchVaccineUrl
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
        return $query->orWhere('description','like', '%' . $value . '%')
            ->orWhere('state_initial','like', '%' . $value . '%')
            ->orWhere('remarks','like', '%' . $value . '%');
    }
}
