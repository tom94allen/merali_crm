@extends('layouts.app')

@section('content')
    @if ($error != null)
        <div class="row">
            <div class="col-lg alert alert-danger">
                {{$error}}
            </div>
        </div>
    @endif
    
    <div class="row">
        <div class="col-lg-6" >
            <h1 class="welcome" style="margin-bottom:0 !important">All contacts for {{$customer->name}}</h1>
        </div>
        <div class="col-lg-6" id="ver-align">
            <div class="float-right">
                <a class="cust-btns" style="padding:5px 20px !important" href='{{url()->previous()}}'>Go Back</a>
            </div>
        </div>
    </div>
    <br>
    <br>

    <div id="filter-by">
        <div class="row">
            <div class="col-lg">
                <h4 class="welcome">Filter Results</h4>
                <hr>
                <button style="margin:0 !important;" type="button" class="cust-btns" data-toggle="modal" data-target="#filter-form">
                    Advanced Search
                </button>
                <a style="margin:0 0 0 10px !important;" href='../showcontacts/{{$customer->customer_id}}' class="cust-btns">
                    Remove Filters
                </a>
            </div>
        </div>
    </div>

    <div id="filter-results">
        <div class="row">
            @if($cust_contacts)
                @foreach ($cust_contacts as $contact)
                    <div class="card col-lg-2 contact-card" style="margin:auto">
                        @if ($contact->type_id == 1)
                            <img class="card-img-top card-image" src="{{asset('images/phone.png')}}">
                            <div class="card-body">
                                <div class="card-title" style="text-align:center">Phone Call</div>
                        @elseif($contact->type_id == 2)
                            <img class="card-img-top card-image" src="{{asset('images/email.png')}}">
                            <div class="card-body">
                                <div class="card-title" style="text-align:center">Email</div>
                        @elseif($contact->type_id == 3)
                            <img class="card-img-top card-image" src="{{asset('images/facetoface.png')}}">
                            <div class="card-body">
                                <div class="card-title" style="text-align:center">Face to Face</div>
                        @endif
                                <p class="card-text main-text" style="text-align:center">{{$contact->created_at->format('d/m/Y')}}</p>
                                <p class="card-text main-text" style="text-align:center">{{$customer->name}}</p>
                                <div class="text-center">
                                    <a href="../{{$contact->contact_id}}" class="main-text contact-view">View Contact</a>
                                </div>
                            </div>
                    </div>
                @endforeach
            @elseif($results)
                @foreach ($results as $contact)
                    <div class="card col-lg-2 contact-card" style="margin:auto">
                        @if ($contact->type_id == 1)
                            <img class="card-img-top card-image" src="{{asset('images/phone.png')}}">
                            <div class="card-body">
                                <div class="card-title" style="text-align:center">Phone Call</div>
                        @elseif($contact->type_id == 2)
                            <img class="card-img-top card-image" src="{{asset('images/email.png')}}">
                            <div class="card-body">
                                <div class="card-title" style="text-align:center">Email</div>
                        @elseif($contact->type_id == 3)
                            <img class="card-img-top card-image" src="{{asset('images/facetoface.png')}}">
                            <div class="card-body">
                                <div class="card-title" style="text-align:center">Face to Face</div>
                        @endif
                                <p class="card-text main-text" style="text-align:center">{{$contact->created_at}}</p>
                                <p class="card-text main-text" style="text-align:center">{{$customer->name}}</p>
                                <div class="text-center">
                                    <a href="contacts/{{$contact->contact_id}}" class="main-text contact-view">View Contact</a>
                                </div>
                            </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="modal fade" id="filter-form" tabindex="-1" role="dialog" aria-labelledby="filter-formTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Advanced Search</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => ['ContactsController@advancedSearch', $customer->customer_id], 'method' => 'GET', 'class' => 'col-lg', 'style' => 'margin:auto']) !!}
                    <div class="row">
                        <div class="col">
                            &nbsp;{!! Form::label('date_from', 'Date From', ['class' => 'main-text', 'style' => 'width:50%']) !!}
                            {!! Form::date('date_from', '', ['class' => 'form-control', 'id' => 'date_from']) !!}
                        </div>
                        <div class="col">
                            &nbsp;{!! Form::label('date_to', 'Date To', ['class' => 'main-text', 'style' => 'width:50%']) !!}
                            {!! Form::date('date_to', '', ['class' => 'form-control', 'id' => 'date_to']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            &nbsp;{!! Form::label('created_by', 'Created By', ['class' => 'main-text', 'style' => 'width:50%; margin-top:5px;']) !!}
                            <select name="created_by" class="main-text form-control">
                                <option value="" name="created_by">Please Select</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col">
                            &nbsp;{!! Form::label('type_id', 'Contact Type', ['class' => 'main-text', 'style' => 'width:50%; margin-top:5px;']) !!}
                            <select name="type_id" class="main-text form-control">
                                <option value="">Please Select</option>
                                    @foreach ($con_type as $type)
                                        <option value="{{$type->type_id}}">{{$type->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" class="cust-btns" style="margin: 10px 5px 10px 0" data-dismiss="modal">Close</button>
                    {!! Form::submit('Apply Filter', ['type' => 'button', 'class' => 'cust-btns']) !!}
                {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
</div> 
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection