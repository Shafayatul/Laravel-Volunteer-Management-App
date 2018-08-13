{{ Form::label('name', 'Name:') }}
{{ Form::text('name', null, array("class" => "form-control", "required" => "required", "maxlength" => "191")) }}
{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary form-margin']) !!}