@extends('layouts.app')

@section('content')

<div class="row">
    <h1 class="col-lg welcome">Welcome {{Auth::user()->name}}!</h1>
</div>

<div class="row">
    <button id="view_button" class="col-lg-2 main-text change-view" onclick="updateView()">&nbsp Show All Tasks</button>
    <a class="col-lg-2 main-text change-view" href="{{url('/tasks/create')}}">{{ __('Add Task') }}</a>
</div>
<br>

<div id="week_view" class="show">
    <div class="row">
        <p class="col-lg main-text">&nbsp; Let's see what you've got on this week...</p>
    </div>
    <br>

    @if(Auth::user())
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Monday</div>
                    @foreach ($tasks as $task)
                        @if($task->user_id == Auth::user()->id)
                            @if($task->status_id != 3)
                                @if ($task->day_due == 'Monday')
                                    <div class="card task-card">
                                        <a href="tasks/{{$task->task_id}}/edit">
                                            <div class="card-body">
                                                <div class="card-title">{{$task->task_name}}</div>
                                                <hr>
                                                <div class="card-text main-text">Due : {{$task->due_date->format('d/m/Y')}}</div>
                                                @switch($task->status_id)
                                                    @case(1)
                                                        <div class="card-text main-text">Status : Not Started</div>
                                                        @break
                                                    @case(2)
                                                    <div class="card-text main-text">Status : Overdue</div>
                                                        @break
                                                    @case(3)
                                                        <div class="card-text main-text">Status : Completed</div>
                                                        @break
                                                    @default
                                                        @break 
                                                @endswitch
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endif
                        @endif
                    @endforeach  
            </div>
        </div>
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Tuesday</div>
                    @foreach ($tasks as $task)
                        @if($task->user_id == Auth::user()->id)
                            @if($task->status_id != 3)
                                @if ($task->day_due == 'Tuesday')
                                    <div class="card task-card">
                                        <a href="tasks/{{$task->task_id}}/edit">
                                            <div class="card-body">
                                                <div class="card-title">{{$task->task_name}}</div>
                                                <hr>
                                                <div class="card-text main-text">Due : {{$task->due_date->format('d/m/Y')}}</div>
                                                @switch($task->status_id)
                                                    @case(1)
                                                        <div class="card-text main-text">Status : Not Started</div>
                                                        @break
                                                    @case(2)
                                                    <div class="card-text main-text">Status : Overdue</div>
                                                        @break
                                                    @case(3)
                                                        <div class="card-text main-text">Status : Completed</div>
                                                        @break
                                                    @default
                                                        @break 
                                                @endswitch
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endif
                        @endif
                    @endforeach  
            </div>
        </div>
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Wednesday</div>
                    @foreach ($tasks as $task)
                        @if($task->user_id == Auth::user()->id)
                            @if($task->status_is != 3)
                                @if ($task->day_due == 'Wednesday')
                                    <div class="card task-card">
                                        <a href="tasks/{{$task->task_id}}/edit">
                                            <div class="card-body">
                                                <div class="card-title">{{$task->task_name}}</div>
                                                <hr>
                                                <div class="card-text main-text">Due : {{$task->due_date->format('d/m/Y')}}</div>
                                                @switch($task->status_id)
                                                    @case(1)
                                                        <div class="card-text main-text">Status : Not Started</div>
                                                        @break
                                                    @case(2)
                                                    <div class="card-text main-text">Status : Overdue</div>
                                                        @break
                                                    @case(3)
                                                        <div class="card-text main-text">Status : Completed</div>
                                                        @break
                                                    @default
                                                        @break 
                                                @endswitch
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endif
                        @endif
                    @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Thursday</div>
                @foreach ($tasks as $task)
                    @if($task->user_id == Auth::user()->id)
                        @if($task->status_id != 3)
                            @if ($task->day_due == 'Thursday')
                                <div class="card task-card">
                                    <a href="tasks/{{$task->task_id}}/edit">
                                        <div class="card-body">
                                            <div class="card-title">{{$task->task_name}}</div>
                                            <hr>
                                            <div class="card-text main-text">Due : {{$task->due_date->format('d/m/Y')}}</div>
                                            @switch($task->status_id)
                                                @case(1)
                                                    <div class="card-text main-text">Status : Not Started</div>
                                                    @break
                                                @case(2)
                                                <div class="card-text main-text">Status : Overdue</div>
                                                    @break
                                                @case(3)
                                                    <div class="card-text main-text">Status : Completed</div>
                                                    @break
                                                @default
                                                    @break 
                                            @endswitch
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Friday</div>
                @foreach ($tasks as $task)
                    @if($task->user_id == Auth::user()->id)
                        @if($task->status_id != 3)
                            @if ($task->day_due == 'Friday')
                                <div class="card task-card">
                                    <a href="tasks/{{$task->task_id}}/edit">
                                        <div class="card-body">
                                            <div class="card-title">{{$task->task_name}}</div>
                                            <hr>
                                            <div class="card-text main-text">Due : {{$task->due_date->format('d/m/Y')}}</div>
                                            @switch($task->status_id)
                                                @case(1)
                                                    <div class="card-text main-text">Status : Not Started</div>
                                                    @break
                                                @case(2)
                                                <div class="card-text main-text">Status : Overdue</div>
                                                    @break
                                                @case(3)
                                                    <div class="card-text main-text">Status : Completed</div>
                                                    @break
                                                @default
                                                    @break 
                                            @endswitch
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Saturday</div>
                @foreach ($tasks as $task)
                    @if($task->user_id == Auth::user()->id)
                        @if($task->status_id != 3)
                            @if ($task->day_due == 'Saturday')
                                <div class="card task-card">
                                    <a href="tasks/{{$task->task_id}}/edit">
                                        <div class="card-body">
                                            <div class="card-title">{{$task->task_name}}</div>
                                            <hr>
                                            <div class="card-text main-text">Due : {{$task->due_date->format('d/m/Y')}}</div>
                                            @switch($task->status_id)
                                                @case(1)
                                                    <div class="card-text main-text">Status : Not Started</div>
                                                    @break
                                                @case(2)
                                                <div class="card-text main-text">Status : Overdue</div>
                                                    @break
                                                @case(3)
                                                    <div class="card-text main-text">Status : Completed</div>
                                                    @break
                                                @default
                                                    @break 
                                            @endswitch
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Sunday</div>
                @foreach ($tasks as $task)
                        @if($task->user_id == Auth::user()->id)
                            @if($task->status_id != 3)
                                @if ($task->day_due == 'Sunday')
                                    <div class="card task-card">
                                        <a href="tasks/{{$task->task_id}}/edit">
                                            <div class="card-body">
                                                <div class="card-title">{{$task->task_name}}</div>
                                                <hr>
                                                <div class="card-text main-text">Due : {{$task->due_date->format('d/m/Y')}}</div>
                                                @switch($task->status_id)
                                                    @case(1)
                                                        <div class="card-text main-text">Status : Not Started</div>
                                                        @break
                                                    @case(2)
                                                    <div class="card-text main-text">Status : Overdue</div>
                                                        @break
                                                    @case(3)
                                                        <div class="card-text main-text">Status : Completed</div>
                                                        @break
                                                    @default
                                                        @break 
                                                @endswitch
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endif
                        @endif
                @endforeach
            </div>
        </div>
    @else 
        <div class="row">
            <div class="col-lg">
                <h6 class="text-center main-text">Lucky You! No tasks due this week</h6>
            </div>
        </div>
    @endif
</div>

<div id="all_task_comment" class="row hide">
    <p class="col-lg main-text">&nbsp; Here's all of your current tasks...</p>
</div>
<br>

<div id="all_task_view" class="hide">

    @if (Auth::user()->id == $user->id)
        @foreach ($tasks as $task)
            @if($task->user_id == Auth::user()->id)
                @if ($task->status_id != 3)
                    <div class="row">
                        <div class="card task-card col-lg">
                            <a href="tasks/{{$task->task_id}}/edit">
                                <div class="card-body">
                                    <div class="card-title">{{$task->task_name}}</div>
                                    <hr>
                                    <div class="card-text main-text">Due : {{$task->due_date->format('d/m/Y')}}</div>
                                    @switch($task->status_id)
                                        @case(1)
                                            <div class="card-text main-text">Status : Open</div>
                                            @break
                                        @case(2)
                                        <div class="card-text main-text">Status : Overdue</div>
                                            @break
                                        @case(3)
                                            <div class="card-text main-text">Status : Completed</div>
                                            @break
                                        @default
                                            @break 
                                    @endswitch
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    @else
        <div class="row">
            <div class="col-lg">
                <h6 class="text-center main-text">Lucky You! You currently have no tasks to complete.</h6>
            </div>
        </div> 
    @endif
</div>

<script src="{{ asset('js/app.js') }}" defer></script>
@endsection