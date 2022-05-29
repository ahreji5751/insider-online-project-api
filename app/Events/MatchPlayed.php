<?php

namespace App\Events;

use App\Models\Match;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatchPlayed
{
    use Dispatchable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Match
     */
    public $match;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Match $match)
    {
        $this->match = $match;
    }
}
