<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $table = 'notifications';

    protected $fillable = [
        'batch_number',
        'batch_date',
        'batch_time',
        'customer_user_id',
        'vaccine_url_id',
        'is_sms_sent',
        'is_email_sent',
        'zipcode_type',
        'distance'
    ];

    public function customer_user()
    {
        return $this->belongsTo(CustomerUser::class, 'customer_user_id');
    }
    public function vaccine_url()
    {
        return $this->belongsTo(VaccineUrl::class, 'vaccine_url_id');
    }
}
