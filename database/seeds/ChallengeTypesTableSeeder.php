<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ChallengeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $challengeTypes = [
            'steps' => 'Number of steps during selected time range.',
            'caloriesOut' => 'Number of calories burned during selected time range.',
            'distance' => 'Distance traveled during selected time range.',
        ];

        foreach($challengeTypes as $name => $description) {
            $row = new App\ChallengeType();
            $row->name = $name;
            $row->description = $description;
            $row->save();
        }

    }
}
