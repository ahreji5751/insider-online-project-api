<?php

namespace App\Listeners;

use App\Events\MatchPlayed;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateTeamStatListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  MatchPlayed  $event
     * @return void
     */
    public function handle(MatchPlayed $event)
    {
        $hostWin = $event->match->host_goals > $event->match->guest_goals;
        $isDraw = $event->match->host_goals == $event->match->guest_goals;
        $hostGoalsDiff = $event->match->host_goals - $event->match->guest_goals;
        $event->match->host->updateScore($hostWin, $isDraw, $hostGoalsDiff);
        $event->match->guest->updateScore(!$hostWin, $isDraw, -$hostGoalsDiff);
    }
}
