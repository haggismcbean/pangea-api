<?php

use Illuminate\Database\Seeder;

use App\Task;
use App\TaskInput;
use App\TaskOutput;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Task::truncate();
        TaskInput::truncate();
        TaskOutput::truncate();

        Task::create([
            'id' => 1,
            'name' => 'travel.land',
            'labour_cost' => 1, // time in seconds it takes to walk one space
        ]);

        TaskOutput::create([
            'task_id' => 1,
            'quantity' => 1
        ]);
    }
}
