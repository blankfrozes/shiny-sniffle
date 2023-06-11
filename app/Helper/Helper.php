<?php

// use Carbon\Carbon;
use Illuminate\Support\Str;

if (!function_exists('includeFilesInFolder')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeFilesInFolder($folder)
    {
        try {
            $rdi = new RecursiveDirectoryIterator($folder);
            $it = new RecursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('includeRouteFiles')) {

    /**
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        includeFilesInFolder($folder);
    }
}

if (!function_exists('gcd')) {

    function gcd($x, $y)
    {
        if ($y == 0) return $x;
        return gcd($y, $x % $y);
    }
}

if (!function_exists('printBoolean')) {

    function printBoolean($value)
    {
        if ($value) return "Yes";
        return "No";
    }
}

if (!function_exists('maskedString')) {

    function maskedString($value)
    {
        $len = Str::length($value);

        $masked = "";
        if ($len < 4) {
            $masked = Str::mask($value, 'x', Str::length($value)-2);
        }else if ($len < 3) {
            $masked = Str::mask($value, 'x', Str::length($value)-1);
        }else{
            $masked = Str::mask($value, 'x', Str::length($value)-3);
        }

        return $masked;
    }
}