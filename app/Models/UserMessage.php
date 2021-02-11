<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMessage extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'user_messages';

    protected $fillable = [
        'user_id',
        'sender_user_id',
        'message',
        'message_timestamp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sender_user()
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }
}
