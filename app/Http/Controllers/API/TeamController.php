<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        return TeamResource::collection(Team::all());
    }
}
