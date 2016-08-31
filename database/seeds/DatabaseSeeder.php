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

        DB::table('Results')->delete();
        DB::table('Coins')->delete();
        DB::table('Challengers')->delete();
        DB::table('Challenges')->delete();
        DB::table('ChallengeType')->delete();
        DB::table('BetType')->delete();
        DB::table('users')->delete();

        $this->call(UserTableSeeder::class);
        $this->call(BetTypeTableSeeder::class);
        $this->call(ChallengeTypeTableSeeder::class);
        $this->call(ChallengesTableSeeder::class);
        $this->call(ChallengersTableSeeder::class);
        $this->call(CoinsTableSeeder::class);
        $this->call(ResultsTableSeeder::class);

        Model::reguard();
    }
}
