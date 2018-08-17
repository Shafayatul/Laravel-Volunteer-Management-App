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
        <div class="{{ $errors->has('phone_number') ? 'has-error' : ''}}">
            {!! Form::label('phone_number', 'Phone Number', ['class' => 'control-label']) !!}
            {!! Form::text('phone_number', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('provide_detail') ? 'has-error' : ''}}">
            {!! Form::label('provide_detail', 'This volunteer system may require a background check.    Will you provide details if required?', ['class' => 'control-label']) !!}
            {!! Form::select('provide_detail', array('Yes' => 'Yes', 'No' => 'No'), null, ['class' => 'form-control']) !!}
            {!! $errors->first('provide_detail', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('current_employer') ? 'has-error' : ''}}">
            {!! Form::label('current_employer', 'Current Employer', ['class' => 'control-label']) !!}
            {!! Form::text('current_employer', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('current_employer', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">

        <div class="{{ $errors->has('years_of_experience') ? 'has-error' : ''}}">
            {!! Form::label('years_of_experience', 'Years Of Experience', ['class' => 'control-label']) !!}
            {!! Form::number('years_of_experience', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('years_of_experience', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('linkedin') ? 'has-error' : ''}}">
            {!! Form::label('linkedin', 'Linkedin', ['class' => 'control-label']) !!}
            {!! Form::text('linkedin', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('linkedin', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('instagram') ? 'has-error' : ''}}">
            {!! Form::label('instagram', 'Instagram', ['class' => 'control-label']) !!}
            {!! Form::text('instagram', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('instagram', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('facebook') ? 'has-error' : ''}}">
            {!! Form::label('facebook', 'Facebook', ['class' => 'control-label']) !!}
            {!! Form::text('facebook', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('facebook', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('twitter') ? 'has-error' : ''}}">
            {!! Form::label('twitter', 'Twitter', ['class' => 'control-label']) !!}
            {!! Form::text('twitter', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('twitter', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('image') ? 'has-error' : ''}}">
            {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
            {!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
        </div>
        <br>
        {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary pull-right form-margin']) !!}
    </div>
</div>