<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsState extends Model
{
    use HasFactory;

    public $table = 'us_states';

    protected $fillable = [
        'state_name',
        'remarks'
    ];
}