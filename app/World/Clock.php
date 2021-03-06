<?php

namespace App\World;

use App\Location;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Clock
{
    public static function getDayOfYear()
    {
        $day1 = date_create(date('2019-01-01'));
        $today = date_create(date('Y-m-d'));

        $difference = $day1->diff($today);

        // Remainder of days / 40
        $modulo = $difference->days % 40;

        return $modulo;
        // returns a number between 0 and 39.
    }

    public static function getSeason()
    {
        $dayOfYear = Clock::getDayOfYear();

        if ($dayOfYear < 10) {
            return 'winter';
        }

        if ($dayOfYear < 20) {
            return 'spring';
        }

        if ($dayOfYear < 30) {
            return 'summer';
        }

        if ($dayOfYear < 40) {
            return 'autumn';
        }
    }

    public static function isWithinDays($currentDay, $comparisonDay, $maxDifference) {
        if ($comparisonDay < 0) {
            $comparisonDay = $comparisonDay + 40;
        }

        if ($comparisonDay > 39) {
            $comparisonDay = $comparisonDay % 40;
        }

        $minDay = Clock::getSubtractedDay($currentDay, ($maxDifference / 2));
        $maxDay = ($comparisonDay + ($maxDifference / 2)) % 40;

        return Clock::isBetween($currentDay, $minDay, $maxDay);
    }

    public static function getLocationTimezone($location)
    {
        $totalXCords = Location::orderBy('id', 'DESC')->first()->x_coord;
        $xCordsPerTimezone = $totalXCords / 24;

        return ($location->x_coord / $xCordsPerTimezone) - 12;
        // returns a number between -12 and 12
    }

    public static function isMidnight($location) {
        // on pangea it is always night except from 12noon to 3pm
        $timezone = Clock::getLocationTimezone($location);
        $currentHour = date('H'); // a number between 0 and 23
        if ($currentHour + $timezone == 0) {
            return true;
        }

        return false;
    }

    public static function isBreakfastHour($location) {
        // on pangea it is always night except from 12noon to 3pm
        $timezone = Clock::getLocationTimezone($location);
        $currentHour = date('H'); // a number between 0 and 23
        if ($currentHour + $timezone == 12 || $currentHour + $timezone == -12) {
            return true;
        }

        return false;
    }

    public static function isLunchHour($location) {
        // on pangea it is always night except from 12noon to 3pm
        $timezone = Clock::getLocationTimezone($location);
        $currentHour = date('H'); // a number between 0 and 23
        if ($currentHour + $timezone == 13) {
            return true;
        }

        return false;
    }

    public static function isDinnerHour($location) {
        // on pangea it is always night except from 12noon to 3pm
        $timezone = Clock::getLocationTimezone($location);
        $currentHour = date('H'); // a number between 0 and 23
        if ($currentHour + $timezone == 14) {
            return true;
        }

        return false;
    }

    public static function getLocationRainzone($location) {
        $totalXCords = $location->orderBy('id', 'DESC')->first()->x_coord;
        $xCordsPerRainzone = $totalXCords / 24;

        return ($location->x_coord / $xCordsPerRainzone) % 4;
        // returns a number between 0 and 3 
    }

    // TODO - random fluctuations of the weather.
    public static function getTemperature($location)
    {
        if (Clock::getSeason() === 'winter') {
            return $location->biome()->first()->coldestTemperature;
        }

        if (Clock::getSeason() === 'summer') {
            return $location->biome()->first()->hottestTemperature;
        }
        
        return $location->biome()->first()->averageTemperature;
    }

    public static function getRainfall($location)
    {
        $dayOfYear = Clock::getDayOfYear();
        $rainzone = Clock::getLocationRainzone($location);

        if ($rainzone === 0 && (Clock::isBetween($dayOfYear, 0, 4) || Clock::isBetween($dayOfYear, 35, 39))) {
            // rainy season
            return $location->biome()->first()->highestRainfall;
        }

        if ($rainzone === 1 && (Clock::isBetween($dayOfYear, 5, 9) || Clock::isBetween($dayOfYear, 30, 34))) {
            // rainy season
            return $location->biome()->first()->highestRainfall;
        }

        if ($rainzone === 2 && (Clock::isBetween($dayOfYear, 10, 14) || Clock::isBetween($dayOfYear, 25, 29))) {
            // rainy season
            return $location->biome()->first()->highestRainfall;
        }

        if ($rainzone === 3 && (Clock::isBetween($dayOfYear, 15, 24))) {
            // rainy season
            return $location->biome()->first()->highestRainfall;
        }

        return $location->biome()->first()->lowestRainfall;
    }

    private static function isBetween($number, $min, $max) {
        return $number >= $min && $number <= $max;
    }

    private static function getSubtractedDay($currentDay, $numberOfDaysToSubtract) {
        $newDay = $currentDay - $numberOfDaysToSubtract;

        if ($newDay < 0) {
            return $newDay + 40;
        }

        return $newDay;
    }
}
