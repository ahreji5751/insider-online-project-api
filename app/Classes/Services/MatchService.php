<?php

namespace App\Classes\Services;

use App\Models\Match;
use App\Models\Team;

class MatchService
{
    public static function generateFixtures($teamIds)
    {
        $matchCombinations = $teamIds->crossJoin($teamIds)->filter(fn($teamId) => $teamId[0] !== $teamId[1]);
        return $matchCombinations->values()->shuffle()->reduce(function($result, $combination, $index) {
            return $result->push([
                'week' => intdiv($index, 2) + 1,
                'host_id' => $combination[0],
                'guest_id' => $combination[1]
            ]);
        }, collect())->toArray();
    }

    public static function generateGoals()
    {
        return [
            'host' => rand(0, 5),
            'guest' => rand(0, 5)
        ];
    }

    public static function populate()
    {
        Team::resetScore();
        Match::query()->truncate();
        Match::populate();
    }

    public static function play(int $week = null)
    {
        $matchesForPlay = Match::query()->filterByWeek($week);
        $matchesForPlay->each(fn($match) => $match->play());
        return $matchesForPlay->with('host')->with('guest');
    }
}
