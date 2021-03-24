<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRight extends Model
{
    use HasFactory;

    public $table = 'user_rights';

    protected $fillable = [
        'user_id',
        'module',
        'can_create',
        'can_read',
        'can_update',
        'can_delete',
        'can_print'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}