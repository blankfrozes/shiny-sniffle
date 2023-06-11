<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Rtphoki\Rtp\Models\Game;
use Rtphoki\Rtp\Rtp;

class HourlyGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto update game rtp, time and pattern hourly';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $games = Game::select(['id', 'provider_id', 'name', 'rtp', 'time', 'first_pattern', 'second_pattern', 'third_pattern'])->get()->load('provider');

        foreach ($games as $game) {
            $game->update([
                'rtp' => Rtp::randomRtp(),
                'time' => Rtp::randomTime(),
                'first_pattern' => Rtp::randomPattern($game->provider->slug),
                'second_pattern' => Rtp::randomPattern($game->provider->slug),
                'third_pattern' => Rtp::randomPattern($game->provider->slug),
            ]);
        }
    }
}