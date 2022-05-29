<?php

namespace App\Http\Controllers\API;

use App\Classes\Services\MatchService;
use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use App\Models\Match;

class MatchController extends Controller
{
    public function populate() {
        MatchService::populate();

        return MatchResource::collection(Match::with('host')->with('guest')->get());
    }

    public function play(int $week = null) {
        $playedMatches = MatchService::play($week);

        return MatchResource::collection($playedMatches->get());
    }
}
