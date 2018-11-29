<?php

namespace App\LabourCalculator;

use App\Task;

class LabourCalculator
{
    public calculateLabourCost($taskName, $character, $toolId=null, $machineId=null) {
        $baseValue = $this->getTaskLabourCost($taskName);

        if ($machineId) {
            $machine = $this->findMachine($machine)
            return $this->calculateLabourCost($machine->taskName, $character, $toolId)
        }

        $characterLabourChange = $this->getCharacterLabourChange($taskName, $character);

        // if we have no tool or machine
        if ($toolId) {
            $toolLabourChange = $this->getToolLabourChange($taskName, $toolId);
        } else {
            $toolLabourChange = 1;
        }

        return $baseValue * $toolLabourChange * $characterLabourChange;
    }

    private getTaskLabourCost($taskName) {
        return Task::where('name', $taskName)->first()->labour_cost;
    }

    private findMachine($taskName) {
        return false;
    }

    private getCharacterLabourChange($taskName) {
        return 1;
    }

    private getToolLabourChange($taskName) {
        return 1;
    }

    public calculateOutput($taskName, $character, $toolId=null, $machineId=null) {
        return 1;
    }
}