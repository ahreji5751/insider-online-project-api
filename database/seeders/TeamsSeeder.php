<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            ['name' => 'Chelsea'],
            ['name' => 'Arsenal'],
            ['name' => 'Manchester City'],
            ['name' => 'Liverpool'],
        ];

        DB::table('teams')->insert($teams);
    }
}
