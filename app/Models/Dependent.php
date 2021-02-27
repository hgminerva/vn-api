<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    use HasFactory;

    public $table = 'dependents';

    protected $fillable = [
        'customer_user_id',
        'customer_user_dependent_id',
        'relationship',
        'remarks'
    ];

    public function customer_user()
    {
        return $this->belongsTo(CustomerUser::class, 'customer_user_id');
    }
    public function customer_user_dependent()
    {
        return $this->belongsTo(CustomerUser::class, 'customer_user_dependent_id');
    }
}
