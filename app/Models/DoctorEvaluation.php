<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorEvaluation extends Model
{
    use HasFactory;

    public $table = 'doctor_evaluations';

    protected $fillable = [
        'doctor_id',
        'institution_id',
        'evaluation_date',
        'evaluation'
    ];

    public function intitution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
