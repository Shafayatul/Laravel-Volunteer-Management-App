@extends('layouts.app')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Volunteer</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Volunteer List
                            </h2>
                        </div>
                        @include('layouts.partials.alert')
                        <div class="body">

                            <table class="table table-hover dashboard-task-infos" id="users-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Registered</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->

                <div id="delete-user-model" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Are you sure that you want to delete this user?</h4>
                      </div>
                      <div class="modal-body">
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn bg-success btn-block btn-lg btn-block btn-user-delete-decision" id="No">No</button>                              
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn bg-danger btn-block btn-lg btn-block btn-user-delete-decision" id="Yes">Yes</button>                              
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
        $('#delete-user-model').modal({
           show:false,
           backdrop:'static'
        });
     
        $(document).on('click', '.user-delete', function(){
            userId = $(this).attr('user-id');
            $('#delete-user-model').modal('show');
        });
        $(document).on('click', '.btn-user-delete-decision', function(){
            var decision = $(this).attr("id");
            if(decision == "Yes"){
                $.ajax({
                     type:'POST',
                     url:"{{ url('/ajax/delete-volunteer') }}",
                     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                     data:{
                        'userId' : userId
                     },
                     success:function(data){
                        $('#delete-user-model').modal('toggle');
                        if(data.msg=="Success"){
                            table.ajax.reload( null, false );
                            // alert("User successfully deleted.");
                        }
                     }
                });
            }else{
                $('#delete-user-model').modal('toggle');
            }
        });
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("/datatable/volunteer-list") }}',
            columns: [
                {data: 'id', name: 'volunteers.id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone_number', name: 'volunteers.phone_number'},
                {data: 'created_at', name: 'volunteers.created_at'},
                {data: 'action'}
            ]
        });
          
    }); 
</script>
    
@endsection