<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Institution extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'institutions';

    protected $fillable = [
        'institutions_number',
        'image_url',
        'institution',
        'introduction',
        'website',
        'enable',
        'user_id',

        'postal_code',
        'address',
        'phone',
        'email',
        'area',
        'remarks',
        
        'founder_name',
        'manager_name',
        'facility_type',                // multi-select:
        'medical_department',           // multi-select:

        'staffs',                       // multi-select: {staff, total_number}
        'number_of_staffs',             
        'hospital_beds',                // multi-select: {bed_type, total_number}
        'number_of_hospital_beds',      
        'patients_a_day',               // multi-select: {patient_type, total_number}
        'number_of_patients_a_day',     
        'specialists',                  // multi-select: {specialist, total_number}
        'number_of_specialists',        
        'treatments',                   // multi-select: {treatment_type, total_number}
        'number_of_treatments'   
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function institutionjobposting()
    {
        return $this->hasOne(InstitutionJobPosting::class);
    }
    
    protected static function boot() {
        parent::boot();
    
        static::creating(function($model){
            $max = self::max('institutions_number') ?? 0;
            $no = intval($max) + 1;

            $model->institutions_number = str_pad($no, 10, '0', STR_PAD_LEFT);
        }); 
    }
}
