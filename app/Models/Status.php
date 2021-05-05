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
        'dev',
        'distri',
        'dossier',
    ];

    public function scopeForAction($query, $action)
    {
        switch ($action) {
            case 'DEVSLATE':
            case 'DEVMINISLATE':
            case 'DEVVG':
            case 'CODEV':
            case 'TVONLINE':
                return $query->where('dev', true);
            case 'FILMOVE':
            case 'DISTSAG':
                return $query->where('dist', true);
        }
    }

    public function scopeForDossier($query)
    {
        return $query->where('dossier', true);
    }
}
