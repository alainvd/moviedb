<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $appends = ['label'];
    protected $fillable = [
        'code',
        'name',
    ];

    public function getLabelAttribute($value): string
    {
        return ucfirst($this->name) . " " . "(" . strtoupper($this->code) . ")";
    }
}
