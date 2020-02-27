@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg">
            <h1 class="welcome">All contacts for {{$customer->name}}</h1>
        </div>
    </div>
@endsection