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
        // return $query->orWhere('vaccine_urls.description','like', '%' . $value . '%')
        //     ->orWhere('us_states.state_name','like', '%' . $value . '%')
        //     ->orWhere('us_states.state_initial','like', '%' . $value . '%')
        //     ->orWhere('vaccine_urls.zipcodes','like', '%' . $value . '%')
        //     ->orWhere('vaccine_urls.site_message','like', '%' . $value . '%')
        //     ->orWhere('vaccine_urls.county','like', '%' . $value . '%')
        //     ->orWhere('vaccine_urls.status','like', '%' . $value . '%')
        //     ->orWhere('vaccine_urls.remarks','like', '%' . $value . '%');
        return $query->orWhere('description','like', '%' . $value . '%')
            ->orWhere('state_initial','like', '%' . $value . '%')
            ->orWhere('zipcodes','like', '%' . $value . '%')
            ->orWhere('site_message','like', '%' . $value . '%')
            ->orWhere('county','like', '%' . $value . '%')
            ->orWhere('status','like', '%' . $value . '%')
            ->orWhere('remarks','like', '%' . $value . '%');
    }
}
