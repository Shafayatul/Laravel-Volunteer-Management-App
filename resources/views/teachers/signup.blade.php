@extends('layouts.front')

@section('content')

<style type="text/css">
	input.transparent-input{
	   background-color:rgba(0,0,0,0) !important;
	   /*border:none !important;*/
	   border-radius: 0 !important;
	}

	.transparent-input { 
	color: #fff; 
	}
	.transparent-input:focus{ 
	color: #fff; 
	}
	.transparent-input::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
	    color: #fff;
	    opacity: 1; /* Firefox */
	}

	.transparent-input:-ms-input-placeholder { /* Internet Explorer 10-11 */
	    color: #fff;
	}

	.transparent-input::-ms-input-placeholder { /* Microsoft Edge */
	    color: #fff;
	}
	.btn-bottom-right{
		position: absolute;
		right:    0;
		bottom:   0;
	}
	.class-list{
		border: 4px dotted white;
		padding: 5px;
	}
</style>

    <header class="masthead text-white">
      <div class="masthead-content">
        <div class="container">
        	<h3 class="masthead-subheading mb-0 text-center" style="font-size: 40px;">Teacher Registration Form</h3>
        	<br>

        	<div class="row">
        		<div class="col-md-8  mx-auto">
        			{!! Form::open(['url' => url('/teacher/signup'), 'files' => true]) !!}
					<div class="row" style="background: rgba(0, 0, 0, 0.56);padding: 3em; min-height: 426px;">
						<div class="col-md-12">
							<h3 class="text-center">Register</h3>
							Thanks for registering your class with us. Please complete the information below. You will receive a confirmation email shortly.
							<br>
							<br>
						</div>
						
					    <div class="col-sm-6">
					        <div class="{{ $errors->has('first_name') ? 'has-error' : ''}}">
					            {!! Form::text('first_name', null, ('required' == 'required') ? ['class' => 'form-control transparent-input', 'required' => 'required', 'placeholder' => 'First Name*'] : ['class' => 'form-control transparent-input', 'placeholder' => 'First Name*']) !!}
					            {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
					        </div>
					        <br>
					        <div class="{{ $errors->has('last_name') ? 'has-error' : ''}}">
					            {!! Form::text('last_name', null, ('' == 'required') ? ['class' => 'form-control transparent-input', 'required' => 'required', 'placeholder' => 'Last Name'] : ['class' => 'form-control transparent-input', 'placeholder' => 'Last Name']) !!}
					            {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
					        </div>
					        <br>
					        <div class="{{ $errors->has('email') ? 'has-error' : ''}}">
					            {!! Form::email('email', null, ('required' == 'required') ? ['class' => 'form-control transparent-input', 'required' => 'required', 'placeholder' => 'Email'] : ['class' => 'form-control transparent-input', 'placeholder' => 'Email']) !!}
					            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
					        </div>
					        <br>
					        <div class="{{ $errors->has('password') ? 'has-error' : ''}}">
					            {!! Form::text('password', null, ('required' == 'required') ? ['class' => 'form-control transparent-input', 'required' => 'required', 'placeholder' => 'Password*'] : ['class' => 'form-control transparent-input', 'placeholder' => 'Password*']) !!}
					            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
					        </div>
					        <br>
					        <div class="{{ $errors->has('phone_number') ? 'has-error' : ''}}">
					            {!! Form::text('phone_number', null, ('' == 'required') ? ['class' => 'form-control transparent-input', 'required' => 'required', 'placeholder' => 'Phone Number'] : ['class' => 'form-control transparent-input', 'placeholder' => 'Phone Number']) !!}
					            {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
					        </div>
					        <br>
					        <div class="{{ $errors->has('school_name') ? 'has-error' : ''}}">
					            {!! Form::text('school_name', null, ('' == 'required') ? ['class' => 'form-control transparent-input', 'required' => 'required', 'placeholder' => 'School Name'] : ['class' => 'form-control transparent-input', 'placeholder' => 'School Name']) !!}
					            {!! $errors->first('school_name', '<p class="help-block">:message</p>') !!}
					        </div>
					        <br>
			        		<div class="{{ $errors->has('image') ? 'has-error' : ''}}">
			        			<p>Upload Profile Image:</p>
			        			{!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
			        		</div> 
					    </div>
					    <div class="col-sm-6">


					    	<div class="class-list">
					    		<br>
						    	<h6 class="text-center">List Classes You Manage:</h6>
						    	<hr>
						        <div class="{{ $errors->has('class_one') ? 'has-error' : ''}}">
						            {!! Form::text('class_one', null, ('' == 'required') ? ['class' => 'form-control transparent-input', 'required' => 'required', 'placeholder' => 'Class Period, Week Day, Time:'] : ['class' => 'form-control transparent-input', 'placeholder' => 'Class Period, Week Day, Time:']) !!}
						            {!! $errors->first('class_one', '<p class="help-block">:message</p>') !!}
						        </div>
						        <br>

						        <div class="{{ $errors->has('class_two') ? 'has-error' : ''}}">
						            {!! Form::text('class_two', null, ('' == 'required') ? ['class' => 'form-control transparent-input', 'required' => 'required', 'placeholder' => 'Class Period, Week Day, Time:'] : ['class' => 'form-control transparent-input', 'placeholder' => 'Class Period, Week Day, Time:']) !!}
						            {!! $errors->first('class_two', '<p class="help-block">:message</p>') !!}
						        </div>
						        <br>

						        <div class="{{ $errors->has('class_three') ? 'has-error' : ''}}">
						            {!! Form::text('class_three', null, ('' == 'required') ? ['class' => 'form-control transparent-input', 'required' => 'required', 'placeholder' => 'Class Period, Week Day, Time:'] : ['class' => 'form-control transparent-input', 'placeholder' => 'Class Period, Week Day, Time:']) !!}
						            {!! $errors->first('class_three', '<p class="help-block">:message</p>') !!}
						        </div>
						        <br>

					    	</div>

					        {!! Form::submit('Register', ['class' => 'btn btn-secondary btn-bottom-right']) !!}
					    </div>
					    
					</div>
					{!! Form::close() !!}
        		</div>
        	</div>




        </div>
      </div>
      <div class="bg-circle-1 bg-circle"></div>
      <div class="bg-circle-2 bg-circle"></div>
      <div class="bg-circle-3 bg-circle"></div>
      <div class="bg-circle-4 bg-circle"></div>
    </header>

@endsection