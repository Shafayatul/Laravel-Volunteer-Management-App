<div class="row">
    <div class="col-md-6">
        <div class="{{ $errors->has('first_name') ? 'has-error' : ''}}">
            {!! Form::label('first_name', 'First Name', ['class' => 'control-label']) !!}
            {!! Form::text('first_name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('last_name') ? 'has-error' : ''}}">
            {!! Form::label('last_name', 'Last Name', ['class' => 'control-label']) !!}
            {!! Form::text('last_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('email') ? 'has-error' : ''}}">
            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
            {!! Form::email('email', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('password') ? 'has-error' : ''}}">
            {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
            {!! Form::text('password', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('phone_number') ? 'has-error' : ''}}">
            {!! Form::label('phone_number', 'Phone Number', ['class' => 'control-label']) !!}
            {!! Form::text('phone_number', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="{{ $errors->has('school_name') ? 'has-error' : ''}}">
            {!! Form::label('school_name', 'School Name', ['class' => 'control-label']) !!}
            {!! Form::text('school_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('school_name', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="{{ $errors->has('class_one') ? 'has-error' : ''}}">
            {!! Form::label('class_one', 'Class Period, Week Day, Time:', ['class' => 'control-label']) !!}
            {!! Form::text('class_one', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('class_one', '<p class="help-block">:message</p>') !!}
        </div>


        <div class="{{ $errors->has('class_two') ? 'has-error' : ''}}">
            {!! Form::label('class_two', 'Class Period, Week Day, Time:', ['class' => 'control-label']) !!}
            {!! Form::text('class_two', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('class_two', '<p class="help-block">:message</p>') !!}
        </div>


        <div class="{{ $errors->has('class_three') ? 'has-error' : ''}}">
            {!! Form::label('class_three', 'Class Period, Week Day, Time:', ['class' => 'control-label']) !!}
            {!! Form::text('class_three', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('class_three', '<p class="help-block">:message</p>') !!}
        </div>

        <br>
        <br>

        {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary form-marign pull-right']) !!}
    </div>
</div>