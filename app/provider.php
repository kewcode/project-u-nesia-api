<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provider extends Model
{
    protected $fillable = [
        'provider', 'token', 'user_id',
    ];
}
