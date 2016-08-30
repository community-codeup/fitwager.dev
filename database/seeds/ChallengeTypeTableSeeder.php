<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ChallengeTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $challengeTypes = [
            'Steps' => 'Number of steps during selected time range.',
            'Calories' => 'Number of calories burned during selected time range.',
            'Distance' => 'Distance traveled during selected time range.',
        ];
        foreach($challengeTypes as $name => $description) {
            $row = new App\ChallengeType();
            $row->name = $name;
            $row->description = $description;
            $row->save();
        }
    }
}
