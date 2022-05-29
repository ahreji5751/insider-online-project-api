<?php

namespace Tests\Feature;

use App\Models\Match;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class MatchControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_should_populate_correct_data()
    {
        $this->postJson(route('match.populate'))
            ->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) =>
                $json->has('data')
                    ->has('data.0', fn($json) =>
                        $json->has('id')
                            ->has('week')
                            ->has('host_team')
                            ->has('guest_team')
                            ->etc()
                    )
            );

        $matchCount = Match::count();
        $this->assertNotEquals(0,$matchCount);
        $this->assertDatabaseCount('matches', $matchCount);
    }

    /** @test */
    public function it_should_play_week_simulation_successfully()
    {
        $this->postJson(route('play.week', ['week' => 1]))
            ->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) =>
                $json->has('data', 2)
                    ->has('data.0', fn($json) =>
                        $json->has('id')
                            ->has('week')
                            ->has('host_team')
                            ->has('guest_team')
                            ->etc()
                        )
                );

        $playedMatch = Match::filterByWeek(1)->first();
        $this->assertNotEquals(0, $playedMatch->host->p);
        $this->assertNotEquals(0, $playedMatch->guest->p);
    }

    /** @test */
    public function it_should_play_whole_simulation_successfully()
    {
        $this->postJson(route('play.all'))
            ->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) =>
            $json->has('data')
                ->has('data.0', fn($json) =>
                $json->has('id')
                    ->has('week')
                    ->has('host_team')
                    ->has('guest_team')
                    ->etc()
                )
            );

        $lastPlayedMatch = Match::query()->orderBy('id', 'DESC')->first();
        $hostMatchesCount = Match::where('host_id', $lastPlayedMatch->host_id)
            ->orWhere('guest_id', $lastPlayedMatch->host_id)
            ->count();
        $guestMatchesCount = Match::where('guest_id', $lastPlayedMatch->guest_id)
            ->orWhere('host_id', $lastPlayedMatch->guest_id)
            ->count();
        $this->assertNotEquals(0, $lastPlayedMatch->host->p);
        $this->assertNotEquals(0, $lastPlayedMatch->guest->p);
        $this->assertEquals($hostMatchesCount, $lastPlayedMatch->host->p);
        $this->assertEquals($guestMatchesCount, $lastPlayedMatch->guest->p);
    }
}
