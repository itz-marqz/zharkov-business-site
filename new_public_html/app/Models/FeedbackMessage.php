<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackMessage extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'ip',
        'status',
    ];
}
