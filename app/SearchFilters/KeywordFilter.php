<?php

namespace App\SearchFilters;

use Illuminate\Database\Eloquent\Builder;

class KeywordFilter
{
    /**
     * This handles the "keyword" search.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function handle(Builder $query, $value)
    {
        $keywords =  explode(',', $value);

        return $query->orWhere(function ($query) use ($keywords) {
            foreach ($keywords as $key => $val) {
                if($val) {
                    $query->where('keywords','like', '%' . $val . '%');
                }
            }
        });
    }
}
