<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineUrl extends Model
{
    use HasFactory;

    public $table = 'vaccine_urls';

    protected $fillable = [
        'description',
        'url_address',
        'url_registration',
        'site_message',
        'phase_served',
        'last_updated',
        'current_content',
        'previous_content',
        'remarks',
        'can_scrape',
        
        'us_state_id',
        'state_initial',
        'county',
        'zipcodes',
        'latitude',
        'longitude',

        'status',
        'category',
        'rank',
        'enabled'
    ];

    public function us_state()
    {
        return $this->belongsTo(UsState::class, 'us_state_id');
    }
}
