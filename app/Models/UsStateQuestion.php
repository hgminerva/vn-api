<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsStateQuestion extends Model
{
    use HasFactory;

    public $table = 'us_state_questions';

    protected $fillable = [
        'us_state_id',
        'question',
        'question_value'
    ];

    public function us_state()
    {
        return $this->belongsTo(UsState::class, 'us_state_id');
    }
}