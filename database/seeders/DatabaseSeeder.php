<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Rtphoki\Rtp\Database\Seeders\GameSeeder;
use Rtphoki\Rtp\Database\Seeders\ProviderSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TournamentSeeder::class,
            ConfigSeeder::class,
            ProviderSeeder::class,
            GameSeeder::class,
        ]);
    }
}