<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    const DRAFT = 1;
    const NEW = 2;

    public $fillable = [
        'name',
        'public'
    ];
}
