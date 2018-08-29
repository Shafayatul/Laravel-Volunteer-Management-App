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
                            <table class="table table-hover dashboard-task-infos" id="users-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Committed</th>
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
        var table = $('#users-table').DataTable({
            "bPaginate": false,
            processing: true,
            serverSide: true,
            ajax: '{{ url("/datatable/commited-volunteer-list/".$id) }}',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone_number', name: 'volunteers.phone_number'},
                {data: 'commited', name: 'commited'},
                {data: 'action'}
            ]
        });
          
    }); 
</script>
    
@endsection