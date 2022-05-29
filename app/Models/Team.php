<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'pts',
        'p',
        'w',
        'd',
        'l',
        'gd'
    ];

    public function updateScore(bool $isWin, bool $isDraw, int $goalsDiff)
    {
        $this->update([
            'pts' => $isWin ? $this->pts + 3 : ($isDraw ? $this->pts + 1 : $this->pts),
            'p' => $this->p + 1,
            'w' => $isWin ? $this->w + 1 : $this->w,
            'd' => $this->d + ($isDraw ? 1 : 0),
            'l' => $this->l + (!$isWin && !$isDraw ? 1 : 0),
            'gd' => $this->gd + $goalsDiff
        ]);
    }

    public static function resetScore()
    {
        self::query()->update(['pts' => 0, 'p' => 0, 'w' => 0, 'd' => 0, 'l' => 0, 'gd' => 0]);
    }
}
