<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class PingPosition extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ping-position';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $coordinates = [
            'latitude' => rand( -33 * 1000000, 5 * 1000000) / 1000000,
            'longitude' => rand( -73 * 1000000, -34 * 1000000) / 1000000,
        ];

        Cache::put('last_coordinates', $coordinates, now()->addSeconds(15));

        $this->info('Coordinates updated: ' . json_encode($coordinates));
    }
}
