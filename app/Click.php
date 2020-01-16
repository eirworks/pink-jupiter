<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    protected $casts = [
        'data' => 'array',
    ];

    protected $fillable = [
        'service_id', 'session','data', 'fee', 'user_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
