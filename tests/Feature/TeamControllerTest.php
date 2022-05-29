<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TeamControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_should_successfully_return_list_of_teams()
    {
        $this->getJson(route('team.index'))
            ->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) =>
                $json->has('data', Team::count())
                    ->has('data.0', fn($json) =>
                        $json->has('id')
                            ->has('name')
                            ->etc()
                    )
            );
    }
}
