<?php

namespace App\LabourCalculator;

use App\Task;

class LabourCalculator
{
    public static function calculateTimeLock($taskName, $character, $toolId=null, $machineId=null) {
        $baseValue = LabourCalculator::getTaskLabourCost($taskName);

        if ($machineId) {
            $machine = LabourCalculator::findMachine($machine);
            return LabourCalculator::calculateLabourCost($machine->taskName, $character, $toolId);
        }

        $characterLabourChange = LabourCalculator::getCharacterLabourChange($taskName, $character);

        // if we have no tool or machine
        if ($toolId) {
            $toolLabourChange = LabourCalculator::getToolLabourChange($taskName, $toolId);
        } else {
            $toolLabourChange = 1;
        }

        // set the default timezone to use. Available since PHP 5.1
        date_default_timezone_set('UTC');

        $delay = $baseValue * $toolLabourChange * $characterLabourChange;

        return date('Y-m-d H:i:s', strtotime($delay . ' second'));
    }

    private static function getTaskLabourCost($taskName) {
        return Task::where('name', $taskName)->first()->labour_cost;
    }

    private static function findMachine($taskName) {
        return false;
    }

    private static function getCharacterLabourChange($taskName) {
        return 1;
    }

    private static function getToolLabourChange($taskName) {
        return 1;
    }

    public static function calculateOutput($taskName, $character, $toolId=null, $machineId=null) {
        return 1;
    }
}