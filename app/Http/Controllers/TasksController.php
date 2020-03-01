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
        //getting data
        $auth_id = Auth::user()->id;
        $user = User::where('id', $auth_id)->firstOrFail();
        $status = TaskStatus::all();
        $tasks = Task::all();
        //setting the range of dates for the current week
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d');
        
        //forming an associate array with days of weeks as keys and mapping their dates for the current week respectively
        $dates = array();
        $period = CarbonPeriod::create($weekStartDate, $weekEndDate);
        
        foreach($period as $k => $date){
            array_push($dates, $date);
        }
        $collection = collect(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
        $combined = $collection->combine([$dates[0], $dates[1], $dates[2], $dates[3], $dates[4], $dates[5], $dates[6]]);
        
        $curr_week = $combined->all();

        //assiging a due day to the column in the task table
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
        $customers = Customer::all();
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
        $customers = Customer::all();
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
}
