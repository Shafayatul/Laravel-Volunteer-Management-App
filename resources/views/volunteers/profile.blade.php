@extends('layouts.app')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Profile</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                My Profile
                            </h2>
                        </div>
                        @include('layouts.partials.alert')
                        <div class="body">
                            
                        	<div class="row">
                        		<div class="col-md-6">
									<div class="row">
		                        		<div class="col-md-4">
		                        			<img src="{{ url('/uploads/'.$volunteer->image) }}" class="img-thumbnail">
		                        			}
		                        		</div>
		                        		<div class="col-md-8">

		                        		</div>

		                        	</div>
                        		</div>

                        		<div class="col-md-6">
                        			
                        		</div>
                        	</div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
@endsection