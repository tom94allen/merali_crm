<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Task;
use App\User;
use App\Customer;
use App\TaskStatus;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get necessary data
        $user = Auth::user();
        $tasks = DB::select(DB::raw('select t.task_id, t.task_name, t.due_date, t.due_day, t.status_id, u.name, ts.text, c.name
                                    from tasks t
                                    left join task_status ts on t.status_id = ts.status_id
                                    left join users u on t.user_id = u.id
                                    left join customers c on t.customer_id = c.customer_id
                                    where t.user_id = '.$user->id.'
                                    and t.status_id <> 3
                                    order by t.due_date asc;'));
        //dates for current week
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d');
        $period = CarbonPeriod::create($weekStartDate, $weekEndDate);
        $dates = array();

        //map the dates for current week against their respective days
        foreach($period as $k => $date){
            array_push($dates, $date);
        }
        $collection = collect(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
        $combined = $collection->combine([$dates[0], $dates[1], $dates[2], $dates[3], $dates[4], $dates[5], $dates[6]]);
        $curr_week = $combined->all();
        
        $monday = Carbon::parse($curr_week['Monday'])->format('Y-m-d');
        $tuesday = Carbon::parse($curr_week['Tuesday'])->format('Y-m-d');
        $wednesday = Carbon::parse($curr_week['Wednesday'])->format('Y-m-d');
        $thursday = Carbon::parse($curr_week['Thursday'])->format('Y-m-d');
        $friday = Carbon::parse($curr_week['Friday'])->format('Y-m-d');
        $saturday = Carbon::parse($curr_week['Saturday'])->format('Y-m-d');
        $sunday = Carbon::parse($curr_week['Sunday'])->format('Y-m-d');

        foreach($tasks as $task){
            switch($task->due_date){
                case $monday:
                    $task->due_day = "monday";
                    break;
                case $tuesday:
                    $task->due_day = "tuesday";
                    break;
                case $wednesday:
                    $task->due_day = "wednesday";
                    break;
                case $thursday:
                    $task->due_day = "thursday";
                    break;
                case $friday:
                    $task->due_day = "friday";
                    break;
                case $saturday:
                    $task->due_day = "saturday";
                    break;
                case $sunday:
                    $task->due_day = "sunday";
                    break;
            }
        }

        return view('dashboard')->with('user', $user)
                                ->with('monday', $monday)
                                ->with('tuesday', $tuesday)
                                ->with('wednesday', $wednesday)
                                ->with('thursday', $thursday)
                                ->with('friday', $friday)
                                ->with('saturday', $saturday)
                                ->with('sunday', $sunday)
                                ->with('tasks', $tasks);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::where('active_ind', 1)
                               ->orderBy('name', 'ASC')
                               ->get();
        $task_status = TaskStatus::all();
        $users = User::all();
        return view('tasks.create')->with('customers', $customers)->with('task_status', $task_status)->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'task_name' => 'required',
            'due_date' => 'required',
            'details' => 'required',
            'user_id' => 'required',
            'status_id' => 'required',
        ]);
        //Create task

        $task = new Task;
        $task->task_name = $request->input('task_name');
        $task->due_date = $request->input('due_date');
        $task->details =  $request->input('details');
        $task->user_id = $request->input('user_id');
        $task->status_id = $request->input('status_id');
        if($request->input('customer_id')){
            $task->customer_id = $request->input('customer_id');
        }
        else{
            $task->customer_id = NULL;
        }
        $task->created_by = Auth::user()->id;
        $task->save();

        return redirect('/tasks')->with('success', 'Task Created');
        
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
        $task = Task::find($id);
        $customers = Customer::where('active_ind', 1)
                               ->orderBy('name', 'ASC')
                               ->get();
        $task_status = TaskStatus::all();
        $users = User::all();
        return view('tasks.edit')->with('customers', $customers)->with('task_status', $task_status)->with('users', $users)->with('task', $task);
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
        $task = Task::find($id);
        $task->task_name = $request->input('task_name');
        $task->due_date = $request->input('due_date');
        $task->details =  $request->input('details');
        $task->user_id = $request->input('user_id');
        $task->status_id = $request->input('status_id');
        if($request->input('customer_id')){
            $task->customer_id = $request->input('customer_id');
        }
        else{
            $task->customer_id = NULL;
        }
        $task->updated_by = Auth::user()->id;
        $task->save();

        return redirect('/tasks')->with('success', 'Task Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect('/tasks')->with('success', 'Task Deleted');
    }

    public function customerCreate($id)
    {
        $customer = Customer::find($id);
        $all_cust = Customer::all();
        $task_status = TaskStatus::all();
        $users = User::all();
        return view('tasks.customerCreate')->with('customer', $customer)
                                           ->with('all_cust', $all_cust)
                                           ->with('task_status', $task_status)
                                           ->with('users', $users);
    }

    public function customerStore(request $request, $id)
    {
        $this->validate($request, [
            'task_name' => 'required',
            'due_date' => 'required',
            'details' => 'required',
            'user_id' => 'required',
            'status_id' => 'required',
        ]);
        

        $task = new Task;
        $task->task_name = $request->input('task_name');
        $task->due_date = $request->input('due_date');
        $task->details = $request->input('details');
        $task->user_id = $request->input('user_id');
        $task->status_id = $request->input('status_id');
        $task->customer_id = $id;
        
        $task->save();

        return redirect('customers/'.$id)->with('success', 'Task added for this customer');
    }

    public function dayTasks($id)
    {
        
        //dates for current week
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d');
        $period = CarbonPeriod::create($weekStartDate, $weekEndDate);
        $dates = array();

        //map the dates for current week against their respective days
        foreach($period as $k => $date){
            array_push($dates, $date);
        }
        $collection = collect(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
        $combined = $collection->combine([$dates[0], $dates[1], $dates[2], $dates[3], $dates[4], $dates[5], $dates[6]]);
        $curr_week = $combined->all();
        
        //store the day that was clicked
        $task_day = Carbon::parse($curr_week[$id])->format('Y-m-d');
        
        //get tasks from DB with matching due date
        $tasks = DB::select(DB::raw('select t.task_id, t.task_name, t.due_date, ts.text, u.name, c.name, u.name as created_by
                                    from tasks t
                                    left join task_status ts on t.status_id = ts.status_id
                                    left join customers c on t.customer_id = c.customer_id
                                    left join users u on t.user_id = u.id
                                    where t.status_id <> 3
                                    and t.due_date = "'.$task_day.'"'));


        return $tasks;
        return $id;
    }
}


// //getting data
// $auth_id = Auth::user()->id;
// $user = User::where('id', $auth_id)->firstOrFail();
// $status = TaskStatus::all();
// $tasks = Task::all();
// //setting the range of dates for the current week
// $now = Carbon::now();
// $weekStartDate = $now->startOfWeek()->format('Y-m-d');
// $weekEndDate = $now->endOfWeek()->format('Y-m-d');

// //forming an associate array with days of weeks as keys and mapping their dates for the current week respectively
// $dates = array();
// $period = CarbonPeriod::create($weekStartDate, $weekEndDate);

// foreach($period as $k => $date){
//     array_push($dates, $date);
// }
// $collection = collect(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
// $combined = $collection->combine([$dates[0], $dates[1], $dates[2], $dates[3], $dates[4], $dates[5], $dates[6]]);

// $curr_week = $combined->all();

// //assiging a due day to the column in the task table
// foreach($tasks as $task){
//     if($task->due_date == $curr_week['Monday']){
//         $task->day_due = "Monday";
//     }
//     else if($task->due_date == $curr_week['Tuesday']){
//         $task->day_due = "Tuesday";
//     }
//     else if($task->due_date == $curr_week['Wednesday']){
//         $task->day_due = "Wednesday";
//     }
//     else if($task->due_date == $curr_week['Thursday']){
//         $task->day_due = "Thursday";
//     }
//     else if($task->due_date == $curr_week['Friday']){
//         $task->day_due = "Friday";
//     }
//     else if($task->due_date == $curr_week['Saturday']){
//         $task->day_due = "Saturday";
//     }
//     else if($task->due_date == $curr_week['Sunday']){
//         $task->day_due = "Sunday";
//     }
    
// }
// return view('dashboard')->with('user', $user)->with('tasks', $tasks)->with('status', $status);
