<?php

namespace App\Models\Constants;

use Illuminate\Database\Eloquent\Model;

class ConfigKey extends Model
{
    const START_DATE = 'START_DATE';
    const END_DATE = 'END_DATE';
    const LAST_UPDATE = 'LAST_UPDATE';

    public static function getHumanLanguageDict()
    {
        $arr = [];
        $arr[self::START_DATE] = 'Start Date';
        $arr[self::END_DATE] = 'End Date';
        $arr[self::LAST_UPDATE] = 'Last Update';

        return $arr;
    }

    public static function humanize($value)
    {
        return self::getHumanLanguageDict()[$value];
    }

    public static function values()
    {
        return [
            self::START_DATE,
            self::END_DATE,
            self::LAST_UPDATE,
        ];
    }

    public static function options()
    {
        $humanLanguageDict = self::getHumanLanguageDict();

        return collect(
            self::values()
        )->map(
            function ($e) {
                return [
                    'value' => $e,
                    'label' => $e,
                ];
            }
        )->all();
    }
}