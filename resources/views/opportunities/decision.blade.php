@extends('layouts.app')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Opportunity</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                             Opportunity Detail
                            </h2>
                        </div>
                        @include('layouts.partials.alert')
                        <div class="body">

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Tilte: {{$opportunity->title}}</h4>
                                </div>
                                <div class="col-sm-4 text-right">
                                    @if($is_commited==0)
                                    <button type="button" class="btn bg-red waves-effect opportunity-accept" id="{{$id}}">Accept</button>
                                    <button type="button" class="btn bg-light-blue waves-effect opportunity-decline" id="{{$id}}">Decline</button>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <h4>Tasks:</h4>
                                    <hr>

                                    @foreach($tasks as $task)
                                        <b>Task {{ $loop->iteration }} </b>
                                        <br>
                                        <p>
                                            <b>Detail: </b> {{$task->description}}
                                        </p>
                                    @endforeach
                                </div>
                                <div class="col-sm-6">
                                    <h4>All Info About This Opportunity</h4>
                                    <hr>
                                    <p>
                                        <b>date: </b> {{$opportunity->date}}
                                    </p>
                                    <p>
                                        <b>Time: </b> {{$opportunity->start_time}} - {{$opportunity->end_time}}
                                    </p>
                                    <p>
                                        <b>address: </b> {{$opportunity->address}}
                                    </p>
                                    <p>
                                        <b>contact_number: </b> {{$opportunity->contact_number}}
                                    </p>
                                    <p>
                                        <b>contact_name: </b> {{$opportunity->contact_name}}
                                    </p>
                                    <p>
                                        <b>contact_email: </b> {{$opportunity->contact_email}}
                                    </p>
                                    <p>
                                        <b>Limit In Volunteer: </b> 
                                        @if($opportunity->is_volunteer_limit==1) 
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </p>
                                    <p>
                                        <b>number_of_volunteer: </b> {{$opportunity->number_of_volunteer}}
                                    </p>
                                    <p>
                                        <b>detail: </b> {{$opportunity->detail}}
                                    </p>
                                    <p>
                                        <b>number_of_student: </b> {{$opportunity->number_of_student}}
                                    </p>
                                    <p>
                                        <b>is_call: </b> 
                                        @if($opportunity->is_call==1) 
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </p>                                    
                                    <p>
                                        <b>is_published: </b> 
                                        @if($opportunity->is_published==1) 
                                            Published
                                        @else
                                            Saved
                                        @endif
                                    </p>
                                    <p>
                                        <b>Subjects: </b> 
                                        @if($opportunity->subject1==1) 
                                            Subject1
                                        @endif
                                        @if($opportunity->subject2==1) 
                                            Subject2
                                        @endif
                                        @if($opportunity->subject3==1) 
                                            Subject3
                                        @endif
                                        @if($opportunity->subject4==1) 
                                            Subject4
                                        @endif
                                        @if($opportunity->subject5==1) 
                                            Subject5
                                        @endif
                                        @if($opportunity->subject6==1) 
                                            Subject6
                                        @endif
                                        @if($opportunity->subject7==1) 
                                            Subject7
                                        @endif
                                        @if($opportunity->subject8==1) 
                                            Subject8
                                        @endif

                                    </p>
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


@section('footer-script')

    <script type="text/javascript">
        $(function(){
            $('.opportunity-accept').click(function(){
                $.ajax({
                     type:'POST',
                     url:"{{ url('/opportunities/accept') }}",
                     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                     data:{
                        'opportunityId' : $(this).attr('id')
                     },
                     success:function(data){
                        if(data.msg=="Success"){
                            location.reload();
                        }
                     }
                });
            });
            $('.opportunity-decline').click(function(){
                parent.history.back();
                return false;
            });
            
        }); 
    </script>
    
@endsection