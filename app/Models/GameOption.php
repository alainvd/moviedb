<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameOption extends Model
{
    use HasFactory;

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'gameplay_options');
    }

    public static function gameOptionsChoices() {
        $gameOptionsChoices = GameOption::all()
                ->map(fn ($gameOpt) => [
                    'value' => $gameOpt->id,
                    'label' => $gameOpt->name,
                ])
                ->toArray();
            
        return $gameOptionsChoices;
    }
}
