<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamePlatform extends Model
{
    use HasFactory;

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'game_platforms');
    }

    public static function gamePlatformsChoices() {
        $gamePlatformsChoices = GamePlatform::all()
                ->map(fn ($gamePlat) => [
                    'value' => $gamePlat->id,
                    'label' => $gamePlat->name,
                ])
                ->toArray();
            
        return $gamePlatformsChoices;
    }
}

