@extends('layouts.app')

@section('content')
    <br>

    <div id="search-area">
        {!! Form::open(['action' => 'CustomerController@find', 'method' => 'GET', 'class' => 'col-lg']) !!}
            <h6 class="welcome">Search For Customer</h6>
            <hr>
        {!! Form::close() !!}
    </div>
@endsection