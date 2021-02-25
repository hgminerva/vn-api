<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsStateCategory extends Model
{
    use HasFactory;

    public $table = 'us_state_categories';

    protected $fillable = [
        'us_state_id',
        'category',
        'description',
        'question'
    ];

    public function us_state()
    {
        return $this->belongsTo(UsState::class, 'us_state_id');
    }
}