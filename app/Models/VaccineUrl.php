<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineUrl extends Model
{
    use HasFactory;

    public $table = 'vaccine_urls';

    protected $fillable = [
        'us_state_id',
        'url_address',
        'current_content',
        'previous_content',
        'zipcodes',
        'remarks',
        'description',
        'state_initial',
        'category',
        'enabled'
    ];

    public function us_state()
    {
        return $this->belongsTo(UsState::class, 'us_state_id');
    }
}
