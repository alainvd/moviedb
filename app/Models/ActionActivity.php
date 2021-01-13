<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ActionActivity extends Pivot
{
    public $timestamps = false;

    protected $casts = [
        'rules' => 'array',
    ];
}
