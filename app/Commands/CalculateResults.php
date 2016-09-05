<?php

namespace App\Commands;

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
        $josephUser = new CronTest();
        $josephUser->save();

        echo 'Joseph is cool';
    }
}
