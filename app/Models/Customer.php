<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $table = 'customers';

    protected $fillable = [
        'customer_name',
        'contact_person',
        'address',
        'phone_number',
        'email',
        'image_url',
        'remarks',
        'enabled'
    ];
}