<?php

namespace App\Console;

use App\Challenge;
use App\Result;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        \App\Commands\CalculateResults::class,
        //\App\Result::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {

            // 1. Look for completed challenges, where end_date is before mow
            // Challenge::getFinishedChallenges();

            // Loop through all the completed challenges
            // For every challenge get the challengers who accepted the challenge

                // where status = accepted
                // $allChallengers = $challenge->challengers;
                // $actualChallengers = $challenge->acceptedChallengers();
                // if ($allChallengers->count() == $actualChallengers->count())

                    // $activities =FibitInfo::activities($actualChallengers);

                    // Result::determineWinner($actualChallengers, $activities, $challenge->betType->name);

            $challengersArray = Challenge::getChallengersArray();



            $josephUser = new Result;
            $josephUser->challenge_id = 1;
            $josephUser->winner = 1;
            $josephUser->coins_awarded = 1;
            $josephUser->save();
        })->everyMinute();
    }
}
