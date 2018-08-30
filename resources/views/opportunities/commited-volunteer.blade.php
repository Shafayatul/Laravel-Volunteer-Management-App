@extends('layouts.app')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Volunteer Opportunity</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2>
                                        Opportunity Title: {{$opportunity->title}}
                                    </h2>
                                </div>
                                <div class="col-sm-6">
                                    <h2>
                                        Opportunity Number: {{$opportunity->id}}
                                    </h2>
                                </div>
                            </div>
                        </div>

                        @include('layouts.partials.alert')
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-6">
                                    Number of Committed Volunteers:  {{$total_volunteer}}
                                </div>
                                <div class="col-sm-6">
                                    Opportunity Number: {{$empty_position}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">

                                    <button type="button" class="btn bg-indigo waves-effect action-btn" id="approve-volunteer">
                                        <i class="material-icons">trending_up</i>
                                        <span>Approve Volunteer</span>
                                    </button>
                                    <button type="button" class="btn bg-green waves-effect action-btn" id="email-volunteer">
                                        <i class="material-icons">email</i>
                                        <span>EMAIL</span>
                                    </button>
                                    <button type="button" class="btn bg-teal waves-effect action-btn" id="sms-volunteer">
                                        <i class="material-icons">perm_phone_msg</i>
                                        <span>SMS</span>
                                    </button>
                                </div>
                            </div>

                            <table class="table table-hover dashboard-task-infos" id="users-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Committed</th>
                                        <th>Status</th>
                                        <th>Profile</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
            <input type="hidden" id="opportunity-id" value="{{$id}}">
            <div id="assign-volunteer-model" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Please write the message for the volunteer:</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                {{-- <label for="assign-message">Message </label> --}}
                                <textarea class="form-control" id="assign-message" rows="5"></textarea>
                                <small id="message-help" class="form-text text-muted" style="display:none; color: red;">**Message is essential.</small>         
                                <br>
                            <br>            
                            </div>
                            
                            <div class="col-sm-6 col-sm-offset-3 text-center modal-submit-btn" id="approve-btn">
                                <button type="button" class="btn bg-red btn-block waves-effect" id="final-approve">Approve</button>   
                            </div>
                            <div class="col-sm-6 col-sm-offset-3 text-center modal-submit-btn" id="email-btn">
                                <button type="button" class="btn bg-red btn-block waves-effect" id="final-send-email">Send Email</button>   
                            </div>
                            <div class="col-sm-6 col-sm-offset-3 text-center modal-submit-btn" id="sms-btn">
                                <button type="button" class="btn bg-red btn-block waves-effect" id="final-send-sms">Send SMS</button>   
                            </div>

                        </div>      
                    </div>
                </div>
              </div>
            </div>

        </div>
    </section>
@endsection


@section('footer-script')
<script type="text/javascript">
    $(function(){

        $('#assign-volunteer-model').modal({
           show:false,
           backdrop:'static'
        });

        $(document).on('click', '.action-btn', function(){
            
            $('#assign-volunteer-model').modal('show');
            $('.modal-submit-btn').hide();

            if($(this).attr('id')=="approve-volunteer"){
                $('#approve-btn').show();
            }else if($(this).attr('id')=="email-volunteer"){
                $('#email-btn').show();
            }else if($(this).attr('id')=="sms-volunteer"){
                $('#sms-btn').show();
            }            
        });

        $(document).on('click', '#final-approve', function(){
            var assignMessage = $("#assign-message").val();
            if(assignMessage != ""){

                var userId = [];
                $(".filled-in").each(function(){
                    if ($(this).prop('checked')==true){ 
                       userId.push($(this).attr('id'));
                    }
                });

                $.ajax({
                     type:'POST',
                     url:"{{ url('/opportunity/teacher/volunteer-approve/') }}",
                     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                     data:{
                        'userId' : userId,
                        'message' : assignMessage,
                        'opportunityId' : $('#opportunity-id').val(),
                     },
                     success:function(data){
                        $('#assign-volunteer-model').modal('toggle');
                        if(data.msg=="Success"){
                            table.ajax.reload( null, false );
                        }
                     }
                });
            }else{
                $('#message-help').show();
            }
        });





        var table = $('#users-table').DataTable({
            "bPaginate": false,
            processing: true,
            serverSide: true,
            ajax: '{{ url("/datatable/commited-volunteer-list/".$id) }}',
            columns: [
                {data: 'checkbox', name: 'checkbox'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone_number', name: 'volunteers.phone_number'},
                {data: 'commited', name: 'commited'},
                {data: 'status'},
                {data: 'profile'},
            ]
        });
          
    }); 
</script>
    
@endsection