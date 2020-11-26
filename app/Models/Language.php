<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $appends = [
        'label',
        'chipLabel',
    ];
    protected $fillable = [
        'code',
        'name',
    ];

    public function getLabelAttribute(): string
    {
        return ucfirst($this->name) . " " . "(" . strtoupper($this->code) . ")";
    }

    public function getChipLabelAttribute(): string
    {
        return strtoupper($this->code);
    }
}
