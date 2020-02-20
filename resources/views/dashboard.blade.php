@extends('layouts.app')

@section('content')

<div class="row">
    <h1 class="col-lg welcome">Welcome {{Auth::user()->name}}!</h1>
</div>

<div class="row">
    <a class="col-lg-2 main-text change-view" href="" onclick="updateView()">&nbsp Change View</a>
</div>
<br>

<div id="week_view">
    <div class="row">
        <p class="col-lg main-text">&nbsp Let's see what you've got on this week...</p>
    </div>
    <br>

    @if (Auth::user()->id == $user->id)
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Monday</div>
                    @foreach ($tasks as $task)
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
                    @endforeach  
            </div>
        </div>
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Tuesday</div>
                    @foreach ($tasks as $task)
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
                    @endforeach  
            </div>
        </div>
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Wednesday</div>
                    @foreach ($tasks as $task)
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
                    @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Thursday</div>
                @foreach ($tasks as $task)
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
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Friday</div>
                @foreach ($tasks as $task)
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
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Saturday</div>
                @foreach ($tasks as $task)
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
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg welcome day-card">
                <div class="card-title">&nbsp Sunday</div>
                @foreach ($tasks as $task)
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


<script src="{{ asset('js/app.js') }}" defer></script>
@endsection


{{-- <div class="card col-lg task-card">
    {{$k}}
    <a href="tasks/{{$task->task_id}}/edit">
        <div class="card-body">
            <h4 class="card-title">{{$task->task_name}}</h4>
            <hr>
            <h6 class="card-text main-text">Due : {{$task->due_date->format('d/m/Y')}}</h6>
            @switch($task->status_id)
                @case(1)
                    <h6 class="card-text main-text">Status : Not Started</h6>
                    @break
                @case(2)
                <h6 class="card-text main-text">Status : Overdue</h6>
                    @break
                @case(3)
                    <h6 class="card-text main-text">Status : Completed</h6>
                    @break
                @default
                    @break 
            @endswitch
        </div>
    </a>
</div> --}}