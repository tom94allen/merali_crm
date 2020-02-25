<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Task;


class UpdateTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status of tasks to overdue that have passed due date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $today = Carbon::now();
        $all_tasks = Task::all();
        foreach($all_tasks as $task){
            if($task->due_date < $today){
                $entry = Task::where('task_id', $task->task_id)->update(['status_id' => '3']);
            }
        }
    }
}
