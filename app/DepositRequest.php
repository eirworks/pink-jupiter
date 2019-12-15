<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositRequest extends Model
{
    protected $casts = [
        'confirmed' => 'boolean',
    ];
}
