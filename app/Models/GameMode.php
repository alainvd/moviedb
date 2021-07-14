<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameMode extends Model
{
    use HasFactory;
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'game_modes');
    }

    public static function gameModesChoices() {
        $gameModesChoices = GameMode::all()
                ->map(fn ($gameMode) => [
                    'value' => $gameMode->id,
                    'label' => $gameMode->name,
                ])
                ->toArray();
            
        return $gameModesChoices;
    }
}
