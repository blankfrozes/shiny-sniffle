<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;
use App\Models\Constants\ConfigKey;
use Illuminate\Support\Carbon;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (ConfigKey::values() as $configName) {

            $date = Carbon::now();

            if ($configName == ConfigKey::START_DATE) {
                $date = $date->subDay(7);
            }

            if (!Config::where('key', $configName)->first()) {
                Config::create(['key' => $configName, 'value' => $date->toDateString()]);
            }
        }
    }
}