@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Edit Role</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit Role
                            </h2>
                        </div>
                        <div class="body">
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            {!! Form::model($role, [
                                'method' => 'PATCH',
                                'url' => ['/admin/role', $role->id],
                                'class' => 'form-horizontal',
                                'files' => true
                            ]) !!}

                            @include ('role.form', ['submitButtonText' => 'Update'])

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
@endsection