@extends('layouts.app')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Password</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Update Password
                            </h2>
                        </div>
                        @include('layouts.partials.alert')
                        <div class="body">
                            
                            {!! Form::open(['url' => '/update-password', 'class' => 'form-horizontal', 'files' => true]) !!}

                            @include ('update-password.form', ['formMode' => 'create'])

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
@endsection