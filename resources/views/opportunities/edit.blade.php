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
                                Edit Opportunity
                            </h2>
                        </div>
                        @include('layouts.partials.alert')
                        <div class="body">
                            
                            {!! Form::model($opportunity, [
                                'method' => 'PATCH',
                                'url' => ['/opportunities', $opportunity->id],
                                'class' => 'form-horizontal',
                                'files' => true
                            ]) !!}

                            @include ('opportunities.form', ['formMode' => 'edit'])

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
@endsection


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit Opportunity #{{ $opportunity->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/opportunities') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
