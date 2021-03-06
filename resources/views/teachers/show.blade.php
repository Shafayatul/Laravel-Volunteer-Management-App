@extends('layouts.app')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Teacher</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                             Teacher Detail
                            </h2>
                        </div>
                        @include('layouts.partials.alert')
                        <div class="body">

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>ID</th><td>{{ $teacher->id }}</td>
                                        </tr>
                                        <tr><th> User Id </th><td> {{ $teacher->user_id }} </td></tr><tr><th> Password </th><td> {{ $teacher->password }} </td></tr><tr><th> First Name </th><td> {{ $teacher->first_name }} </td></tr>
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