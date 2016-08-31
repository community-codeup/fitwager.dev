<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BetTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $betTypes = [
            'Personal' => 'Bet against and motivate yourself.  You have until the time you set to complete your exercise goal.',
            'Competitive' => 'Compete against a friend or group of friends.  Winner takes all.',
            'United' => 'Set a target with a friend or group of friends.  Should anyone of you fail, everyone loses their wager.',
            'Shared' => 'Set a target with a friend or group of friends.  Anyone who successfully completes the challenge will split the pot.',
            'Motivate' => 'Set a target with a friend or group of friends.  Anyone who successfully completes the challenge will get their wager back.'
        ];
        foreach($betTypes as $name => $description) {
            $row = new App\BetType();
            $row->name = $name;
            $row->description = $description;
            $row->save();
        }
    }
}
