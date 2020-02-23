@extends('layouts.app')

@section('content')

    <div id="search-area">
        <div class="row">
            <div class="col-lg">
                <h4 class="welcome">Search by customer</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <input type="text" name="search_field" id="search_field" class="form-control" placeholder="Begin typing name of customer..." onkeyup="findCustomer();">
                <div id="search_result"></div>
            </div>
        </div>
    </div>

<script src="{{ asset('js/app.js') }}" defer></script>
@endsection