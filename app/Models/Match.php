<?php

namespace App\Models;

use App\Events\MatchPlayed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Classes\Services\MatchService;

class Match extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'host_goals',
        'guest_goals'
    ];

    public static function populate()
    {
        $teamIds = Team::all()->pluck('id');
        self::query()->insert(MatchService::generateFixtures($teamIds));
    }

    public function host()
    {
        return $this->belongsTo(Team::class, 'host_id');
    }

    public function guest()
    {
        return $this->belongsTo(Team::class, 'guest_id');
    }

    public function scopeFilterByWeek($query, $week)
    {
        $query->when($week, fn($query, $week) => $query->where('week', $week));
    }

    public function play()
    {
        $goals = MatchService::generateGoals();
        $this->update([
            'host_goals' => $goals['host'],
            'guest_goals' => $goals['guest']
        ]);

        event(new MatchPlayed($this));
    }
}
