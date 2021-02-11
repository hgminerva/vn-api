<?php

namespace App\SearchFilters;

use Illuminate\Database\Eloquent\Builder;

class MedicalDepartmentsFilter
{
    /**
     * This handles the "medical_departments" filter.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function handle(Builder $query, $value)
    {
        $departments =  explode(',', $value);

        return $query->orWhere(function ($query) use ($departments) {
            foreach ($departments as $key => $val) {
                if ($val) {
                    $query->where('medical_department','like', '%' . $val . '%');
                }
            }
        });
    }
}
