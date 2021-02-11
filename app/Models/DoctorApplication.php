<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorApplication extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'doctor_applications';

    protected $fillable = [
        'doctor_id',
        'job_posting_id',
        'institution_id',
        'applied_date',
        'remarks',
        'status',
    ];

    public function institutionjobposting()
    {
        return $this->belongsTo(InstitutionJobPosting::class, 'job_posting_id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }
}
