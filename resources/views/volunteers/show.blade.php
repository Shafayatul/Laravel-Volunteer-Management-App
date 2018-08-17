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
                                            <th>ID</th><td>{{ $volunteer->id }}</td>
                                        </tr>
                                        <tr><th> User Id </th><td> {{ $volunteer->user_id }} </td></tr><tr><th> First Name </th><td> {{ $volunteer->first_name }} </td></tr><tr><th> Last Name </th><td> {{ $volunteer->last_name }} </td></tr>
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