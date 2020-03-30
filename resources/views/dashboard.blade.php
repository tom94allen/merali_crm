@extends('layouts.app')

@section('content')
    <div class="row">
        <h1 class="col-lg welcome">Welcome {{Auth::user()->name}}!</h1>
    </div>
    <div class="row">
        <div id="buttons" class="col-lg">
            <button id="view_button" class="col-lg-2 main-text change-view" onclick="updateView()">Show All Tasks</button>
            <button class="col-lg-2 main-text change-view" onclick="window.location = '{{route('tasks.create')}}'">{{ __('Add Task') }}</button>
        </div>
    </div>
    <br>

    <div id="week_view" class="show">
        @if($tasks)
            <div class="row">
                <p class="main-text col-lg">&nbsp Let's see what you've got on this week...</p>
            </div>

            <div class="card-deck">
                <div id="monday" class="card day-card">
                    <a href="daytasks/monday">
                        <div class="card-title welcome" style="padding:0px 2px !important;">
                            Monday
                            <div class="float-right main-text"><small>{{date('d/m', strtotime($monday))}}</small></div>
                        </div>
                        <hr style="margin: 0px 0px 5px !important">
                        @foreach($tasks as $task)
                            @if($task->due_day == "monday")
                                <div class="row" >
                                    <div class="card main-text task-card">
                                        <a href="tasks/{{$task->task_id}}/edit">{{$task->task_name}}</a>
                                        <img onclick="quickUpdate()" src="{{asset('images/circle.png')}}" id="{{$task->task_id}}" class="cal-task">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </a>
                </div>
                <div id="tuesday" class="card day-card">
                    <a href="daytasks/tuesday">
                        <div class="card-title welcome" style="padding:0px 2px !important;">
                            Tuesday
                            <div class="float-right main-text"><small>{{date('d/m', strtotime($tuesday))}}</small></div>
                        </div>
                    </a>
                    <hr style="margin: 0px 0px 5px !important">
                    @foreach($tasks as $task)
                        @if($task->due_day == "tuesday")
                            <div class="row" >
                                <div class="card main-text task-card">
                                    <a href="tasks/{{$task->task_id}}/edit">{{$task->task_name}}</a>
                                    <img onclick="quickUpdate()" src="{{asset('images/circle.png')}}" id="{{$task->task_id}}" class="cal-task">
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div id="wednesday" class="card day-card">
                    <a href="daytasks/wednesday">
                        <div class="card-title welcome" style="padding:0px 2px !important;">
                            Wednesday
                            <div class="float-right main-text"><small>{{date('d/m', strtotime($wednesday))}}</small></div>
                        </div>
                        <hr style="margin: 0px 0px 5px !important">
                        @foreach($tasks as $task)
                            @if($task->due_day == "wednesday")
                                <div class="row" >
                                    <div class="card main-text task-card">
                                        <a href="tasks/{{$task->task_id}}/edit">{{$task->task_name}}</a>
                                        <img onclick="quickUpdate()" src="{{asset('images/circle.png')}}" id="{{$task->task_id}}" class="cal-task">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </a>
                </div>
                <div id="thursday" class="card day-card">
                    <a href="daytasks/thursday">
                        <div class="card-title welcome" style="padding:0px 2px !important;">
                            Thursday
                            <div class="float-right main-text"><small>{{date('d/m', strtotime($thursday))}}</small></div>
                        </div>
                        <hr style="margin: 0px 0px 5px !important">
                        @foreach($tasks as $task)
                            @if($task->due_day == "thursday")
                                <div class="row" >
                                    <div class="card main-text task-card">
                                        <a href="tasks/{{$task->task_id}}/edit">{{$task->task_name}}</a>
                                        <img onclick="quickUpdate()" src="{{asset('images/circle.png')}}" id="{{$task->task_id}}" class="cal-task">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </a>
                </div>
                <div id="friday" class="card day-card">
                    <a href="daytasks/friday">
                        <div class="card-title welcome" style="padding:0px 2px !important;">
                            Friday
                            <div class="float-right main-text "><small>{{date('d/m', strtotime($friday))}}</small></div>
                        </div>
                        <hr style="margin: 0px 0px 5px !important">
                        @foreach($tasks as $task)
                            @if($task->due_day == "friday")
                                <div class="row" >
                                    <div class="card main-text task-card">
                                        <a href="tasks/{{$task->task_id}}/edit">{{$task->task_name}}</a>
                                        <img onclick="quickUpdate()" src="{{asset('images/circle.png')}}" id="{{$task->task_id}}" class="cal-task">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </a>
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
    <div class="row hide" id="all_task_comment">
        <p class="main-text col-lg">&nbsp Here are all of your outstanding tasks...</p>
    </div>
    <div id="all_task" class="hide">
        @foreach($tasks as $task)
            
                <div class="row">
                    <div class="card col-lg-11 all-task-card">
                        <div class="card-title" style="margin: 5px 0px !important"><a href="tasks/{{$task->task_id}}/edit">{{$task->task_name}}</a><img onclick="quickUpdate()" src="{{asset('images/circle.png')}}" id="{{$task->task_id}}" class="task-img float-right"></div>
                        <a href="tasks/{{$task->task_id}}/edit"><hr style="margin: 2.5px !important; width:85% !important"></a>
                        <div class="main-text"><small><a href="tasks/{{$task->task_id}}/edit">Due: {{$task->due_date}}</a></small></div>
                        <div class="main-text"><small><a href="tasks/{{$task->task_id}}/edit">Status: {{$task->text}}</a></small></div>
                    </div>
                </div>
            
        @endforeach
    </div>
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection