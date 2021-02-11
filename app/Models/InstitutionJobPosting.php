<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstitutionJobPosting extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'institution_job_postings';

    protected $fillable = [
        'institution_id',
        'image_url',
        'job_posting_number',
        'job_posting_title',
        'job_posting_date',
        'job_posting_expiry_date',
        'job_title',
        'job_type',
        'tag_line',
        'medical_department',
        'description',
        'attention_points',
        'recruitment_background',
        'recommended_points',
        'gender',
        'keywords',
        'enable',

        'salary',
        'working_hours',
        'number_of_working_days',
        'starting_date_of_work',
        'required_skills',
        'required_qualification',
        'minimum_experience_years',
        'desired_skills_and_experience',
        'welcomed_experience',
        'with_duty',                            // select: 有, 無
        'with_stand_by',                        // select: 有, 無
        'with_research_day',                    // select: 有, 無

        'bonus',
        'salary_increase',
        'various_allowances',
        'various_insurances',
        'academic_participation',
        'assistant_academic_participation',
        'work_life_balance',
        'overtime',
        'number_of_cases',
        'doctor_system',
        'holidays',
        'paid_leave',
        'other_holidays',
        'retirement_pay',
        'nursery',

        'work_location',
        'facility_type',
        'office_hours',
        'means_from_nearest_station',
        'nearest_station',
        'transportation',
        'nearest_line',
        'can_commute_by_car',
        'area'
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function doctorapplication()
    {
        return $this->hasOne(DoctorApplication::class);
    }

    public function doctorfavoritejob()
    {
        return $this->hasOne(DoctorFavoriteJob::class);
    }

    protected static function boot() {
        parent::boot();

        static::creating(function($model){
            $max = self::max('job_posting_number') ?? 0;
            $no = intval($max) + 1;

            $model->job_posting_number = str_pad($no, 10, '0', STR_PAD_LEFT);
        });
    }
}
