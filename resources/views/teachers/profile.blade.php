@extends('layouts.app')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Profile</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Profile Info
                            </h2>
                        </div>
                        @include('layouts.partials.alert')
                        <div class="body">
                            
                        	<div class="row">
                        		<div class="col-md-6">
									<div class="row">
                                        <div class="col-md-4">
                                            @if($teacher->image != "")
                                               <img src="{{ url('/uploads/'.$teacher->image) }}" class="img-thumbnail">
                                            @else
                                                <img src="{{ url('/images/user.png') }}" class="img-thumbnail">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <h4>{{$user->name}}</h4>
                                            <p><b>Email:</b> {{$user->email}}</p>
                                            <p><b>Registered:</b> {{date('Y', strtotime($user->created_at))}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
		                        		<div class="col-md-12">
                                            <p><b>Phone:</b> {{$teacher->phone_number}}</p>
                                            <p><b>Scholl:</b> {{$teacher->school_name}}</p>
                                            @if($teacher->class_one !="")
                                            <p><b>Class-1:</b> {{$teacher->class_one}}</p>
                                            @endif
                                            @if($teacher->class_one !="")
                                            <p><b>Class-2:</b> {{$teacher->class_two}}</p>
                                            @endif
                                            @if($teacher->class_one !="")
                                            <p><b>Class-3:</b> {{$teacher->class_three}}</p>
                                            @endif
		                        		</div>
		                        	</div>

                        		</div>
                        		<div class="col-md-6">
                                    <h5 class="text-center">Opportunity Listing History</h5>
                                    <hr>
                                    @foreach($opportunities as $opportunity)
                                        <p>
                                            <b>Title: </b>{{$opportunity->title}}<br>
                                            {{$opportunity->date}} [{{$opportunity->start_time}}-{{$opportunity->end_time}}]
                                        </p>
                                        
                                    @endforeach
                        		</div>
                        	</div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
@endsection