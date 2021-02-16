<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerUser extends Model
{
    use HasFactory;

    public $table = 'customer_users';

    protected $fillable = [
        'customer_id',
        'user_number',

        'last_name',
        'first_name',
        'middle_name',
        'name',
        'date_of_birth',
        'age_group',

        'email',
        'cellphone',
        'address',
        'zipcodes',
        'home_county',

        'distance_willing',
        'keywords',

        'user_id',
        'us_state_id',
        'us_state_category_id',

        'enrollment_date',
        'enrollment_out_date',

        'employment_number',
        'employment_type',
        'employment_county',

        'remarks',
        'enabled'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function us_state()
    {
        return $this->belongsTo(UsState::class, 'us_state_id');
    }
    public function us_state_category()
    {
        return $this->belongsTo(UsStateCategory::class, 'us_state_category_id');
    }
}
