<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('challengers')->delete();
        DB::table('challenges')->delete();
        DB::table('challenge_types')->delete();
        DB::table('bet_types')->delete();
        DB::table('users')->delete();

        $this->call(UsersTableSeeder::class);
        $this->call(BetTypesTableSeeder::class);
        $this->call(ChallengeTypesTableSeeder::class);
        $this->call(ChallengesTableSeeder::class);
        $this->call(ChallengersTableSeeder::class);

        Model::reguard();
    }
}
