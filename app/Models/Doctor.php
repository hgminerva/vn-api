<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'doctors';

    protected $fillable = [
        'doctor_number',
        'image_url',
        'name',
        'furigana',
        'introduction',
        'birth_date',
        'gender',
        'marital_status',
        'enable',
        'user_id',                  // disabled <do not show>

        'place_of_residency',
        'postal_code',
        'address',
        'phone',
        'email',
        
        'work_history',             // multi-select: {Date, Insitution, Position }
        'educational_background',   // multi-select: {Date, Insitution, Education },{Date, Insitution, Position }
        'medical_department',       // multi-select: department,...
        'qualifications',
        'specialist',
        'certified_physician',
        'area_of_expertise',
        'awards',
        
        'living_with_family',       // select: あり, なし
        'have_dependents',          // select: あり, なし
        'remarks'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
            $max = self::max('doctor_number') ?? 0;
            $no = intval($max) + 1;

            $model->doctor_number = str_pad($no, 10, '0', STR_PAD_LEFT);
        }); 
    }
}
