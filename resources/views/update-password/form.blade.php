<div class="{{ $errors->has('old_password') ? 'has-error' : ''}}">
    {!! Form::label('old_password', 'Old Password', ['class' => 'control-label']) !!}
    {!! Form::text('old_password', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('old_password', '<p class="help-block">:message</p>') !!}
</div>
<div class="{{ $errors->has('new_password') ? 'has-error' : ''}}">
    {!! Form::label('new_password', 'New Password', ['class' => 'control-label']) !!}
    {!! Form::text('new_password', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
</div>
<div class="{{ $errors->has('confirm_password') ? 'has-error' : ''}}">
    {!! Form::label('confirm_password', 'Confirm Password', ['class' => 'control-label']) !!}
    {!! Form::text('confirm_password', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('confirm_password', '<p class="help-block">:message</p>') !!}
</div>

    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary form-margin']) !!}
