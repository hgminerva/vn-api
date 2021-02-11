<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorFavoriteJob extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'doctor_favorite_jobs';

    protected $fillable = [
        'doctor_id',
        'job_posting_id',
        'remarks',
    ];

    public function institutionjobposting()
    {
        return $this->belongsTo(InstitutionJobPosting::class, 'job_posting_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
