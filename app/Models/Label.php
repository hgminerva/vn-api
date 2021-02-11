<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model
{
    use SoftDeletes, HasFactory, Notifiable;


    protected $fillable = [
        'code',
        'label',
        'displayed_label'
    ];

    protected static function boot() {
        parent::boot();
    
        static::creating(function($model){
            $max = self::max('code') ?? 0;
            $no = intval($max) + 1;

            $model->code = str_pad($no, 3, '0', STR_PAD_LEFT);
        }); 
    }
}
