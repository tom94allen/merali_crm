<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Task;
use App\User;
use App\TaskStatus;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_id = Auth::user()->id;
        $user = User::where('id', $auth_id)->firstOrFail();
        $status = TaskStatus::all();
        $tasks = Task::all();
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d');
        
        $dates = array();
        $period = CarbonPeriod::create($weekStartDate, $weekEndDate);
        
        foreach($period as $k => $date){
            array_push($dates, $date);
        }
        $collection = collect(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
        $combined = $collection->combine([$dates[0], $dates[1], $dates[2], $dates[3], $dates[4], $dates[5], $dates[6]]);
        
        $curr_week = $combined->all();
        foreach($tasks as $task){
            if($task->due_date == $curr_week['Monday']){
                $task->day_due = "Monday";
            }
            else if($task->due_date == $curr_week['Tuesday']){
                $task->day_due = "Tuesday";
            }
            else if($task->due_date == $curr_week['Wednesday']){
                $task->day_due = "Wednesday";
            }
            else if($task->due_date == $curr_week['Thursday']){
                $task->day_due = "Thursday";
            }
            else if($task->due_date == $curr_week['Friday']){
                $task->day_due = "Friday";
            }
            else if($task->due_date == $curr_week['Saturday']){
                $task->day_due = "Saturday";
            }
            else if($task->due_date == $curr_week['Sunday']){
                $task->day_due = "Sunday";
            }
            
        }
        return view('dashboard')->with('user', $user)->with('tasks', $tasks)->with('status', $status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "Hello";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
