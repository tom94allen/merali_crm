@extends('layouts.app')

@section('content')
    {!! Form::open(['action' => 'ImportsController@import', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'col-lg-6 form-signin', 'style' => 'margin:auto']) !!}
    @csrf    
    <img class="rounded mx-auto d-block" src="{{asset('images/import.png')}}" alt="" width="72" height="72" style="margin:auto">
        <br>
        <h4 class="mb-3 main-text text-center">Please select document to import</h4>
        <div class="row">
            <div class="col">
                {!! Form::file('import_file', ['class' => 'form-control-file', 'style' => 'width:50% !important; margin:auto !important']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <button class="cust-btns"  type="submit" style="width:50% !important;">Upload</button>
            </div>
        </div>
    {!! Form::close() !!}
@endsection