@extends('layouts.app')


@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Roles</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                     @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            <strong>Success!</strong> {{ Session::get('flash_message') }}
                        </div>
                    @endif

                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                        <strong>Error!</strong> {{ Session::get('error') }}
                    </div>
                    @endif   

                    @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <strong>Error!</strong> 
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif


                </div>
            </div>
            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $item)
                                            <tr>
                                                <td>{{ $loop->iteration or $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <a href="{{ url('/admin/role/' . $item->id . '/edit') }}" title="Edit role"><button class="btn btn-primary btn-sm"><i class="material-icons">mode_edit</i></button></a>
                                                    {!! Form::open([
                                                        'method'=>'DELETE',
                                                        'url' => ['/admin/role', $item->id],
                                                        'style' => 'display:inline'
                                                        ]) !!}
                                                    {!! Form::button('<i class="material-icons">delete</i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete role',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                        )) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>                        
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>
        </div>
    </section>
@endsection