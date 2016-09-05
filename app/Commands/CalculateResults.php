<?php

namespace App\Commands;

use App\Result;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use App\CronTest;

class CalculateResults extends Command implements SelfHandling
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $name = 'CalculateResults';
    protected $signature = 'hey';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $josephUser = new Result;
        $josephUser->challenge_id = 1;
        $josephUser->winner = 1;
        $josephUser->coins_awarded = 1;
        $josephUser->save();

        echo 'Joseph is cool';
    }
}
