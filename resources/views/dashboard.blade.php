@extends('layouts.app')

@section('content')

<div class="row">
    <h1 class="col-lg welcome">Welcome {{Auth::user()->name}}!</h1>
</div>

<div class="row">
    <p class="col-lg main-text">&nbsp Let's see what you've got on this week...</p>
</div>

@if (Auth::user()->id == $user->id)
    @foreach ($tasks as $task)
        <div class="row">
                <div class="card col-lg task-card">
                    <a href="/tasks/{{$task->task_id}}/edit">
                        <div class="card-body">
                            <h4 class="card-title">{{$task->task_name}}</h4>
                            <hr>
                            <h6 class="card-text main-text">Due : {{$task->due_date->format('d/m/Y')}}</h6>
                            @switch($task->status_id)
                                @case(1)
                                    <h6 class="card-text main-text">Status : Open</h6>
                                    @break
                                @case(2)
                                <h6 class="card-text main-text">Status : Closed</h6>
                                    @break
                                @default
                                    
                            @endswitch
                        </div>
                    </a>
                </div>
            
        </div>
    @endforeach
    
@else 
    <div class="row">
        <div class="col-lg">
            <h6 class="text-center main-text">Lucky You! No tasks due this week</h6>
        </div>
    </div>
@endif

@endsection
