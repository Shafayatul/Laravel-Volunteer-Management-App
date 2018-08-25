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
                             Volunteer Detail
                            </h2>
                        </div>
                        @include('layouts.partials.alert')
                        <div class="body">

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>ID</th><td>{{ $opportunity->id }}</td>
                                        </tr>
                                        <tr><th> Title </th><td> {{ $opportunity->title }} </td></tr><tr><th> Date </th><td> {{ $opportunity->date }} </td></tr><tr><th> Start Time </th><td> {{ $opportunity->start_time }} </td></tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
@endsection