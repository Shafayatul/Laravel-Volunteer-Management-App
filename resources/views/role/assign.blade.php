@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Assing User</h2>
            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos" id="users-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>                          
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
                <!-- Modal -->
                <div id="assign-user-model" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Assign Specialist</h4>
                      </div>
                      <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="role">Select list:</label>
                                    <select class="form-control" id="role">
                                        @foreach($roles as $role)
                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>  
                                    <br>
                                    <button type="button" id="assign-role-submit" class="btn bg-cyan btn-block btn-lg waves-effect">Submit</button>                              
                                </div>
                            </div>      
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        $('#assign-user-model').modal({
           show:false,
           backdrop:'static'
        });


         //now on button click
         var user_id = "";
        $(document).on('click', '.addign-specialist', function(){
            user_id = $(this).attr('id');
            $('#assign-user-model').modal('show');
        });



        $(document).on('click', '#assign-role-submit', function(){
            var role = $('#role option:selected').val();
            $.ajax({
                 type:'POST',
                 url:'/admin/assignRole',
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 data:{
                    'role' : role,
                    'user_id' : user_id
                 },
                 success:function(data){
                    if(data.msg=="Success"){
                        $('#assign-user-model').modal('hide');
                        var str = '["'+role+'"]';
                        $('#role_'+user_id).html(str);
                    }
                 }
            });
        });


        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("admin/datatable/role_assign") }}',
            columns: [
                {data: 'name', name: 'users.name'},
                {data: 'email', name: 'users.email'},
                {data: 'role'},
                {data: 'action'}
            ]
        });

    }); 
</script>
    
@endsection