


<div class="row">
    <div class="col-sm-6">
        <div class="{{ $errors->has('title') ? 'has-error' : ''}}">
            {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
            {!! Form::text('title', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('date') ? 'has-error' : ''}}">
            {!! Form::label('date', 'Date', ['class' => 'control-label']) !!}
            {!! Form::date('date', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('start_time') ? 'has-error' : ''}}">
            {!! Form::label('start_time', 'Start Time', ['class' => 'control-label']) !!}
            {!! Form::text('start_time', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('start_time', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('end_time') ? 'has-error' : ''}}">
            {!! Form::label('end_time', 'End Time', ['class' => 'control-label']) !!}
            {!! Form::text('end_time', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('end_time', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('address') ? 'has-error' : ''}}">
            {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
            {!! Form::textarea('address', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('contact_number') ? 'has-error' : ''}}">
            {!! Form::label('contact_number', 'Contact Number', ['class' => 'control-label']) !!}
            {!! Form::text('contact_number', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('contact_number', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('contact_name') ? 'has-error' : ''}}">
            {!! Form::label('contact_name', 'Contact Name', ['class' => 'control-label']) !!}
            {!! Form::text('contact_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('contact_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-sm-6">

        <h6 class="text-center">Please Enter All Details and Do Not Forget to SAVE</h6>
        <br>

        <div class="{{ $errors->has('contact_email') ? 'has-error' : ''}}">
            {!! Form::label('contact_email', 'Contact Email', ['class' => 'control-label']) !!}
            {!! Form::text('contact_email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('contact_email', '<p class="help-block">:message</p>') !!}
        </div>


        <br>
        <div class="{{ $errors->has('is_volunteer_limit') ? 'has-error' : ''}}">
            <p><b>Is there a Vol Limit ?</b></p>
            {{ Form::checkbox('is_volunteer_limit', 1, ($opportunity->is_volunteer_limit == '1') ? true : false, ['class' => 'filled-in chk-col-deep-orange', 'id' => 'is_volunteer_limit']) }}
            {{Form::label("is_volunteer_limit", "Only a fixed # of people can participate in this opportunity.") }}<br>
        </div>
        <div class="{{ $errors->has('number_of_volunteer') ? 'has-error' : ''}}">
            {!! Form::label('number_of_volunteer', 'Number Of Volunteer', ['class' => 'control-label']) !!}
            {!! Form::number('number_of_volunteer', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('number_of_volunteer', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('detail') ? 'has-error' : ''}}">
            {!! Form::label('detail', 'Detail', ['class' => 'control-label']) !!}
            {!! Form::textarea('detail', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('detail', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="{{ $errors->has('number_of_student') ? 'has-error' : ''}}">
            {!! Form::label('number_of_student', 'Number Of Student', ['class' => 'control-label']) !!}
            {!! Form::number('number_of_student', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('number_of_student', '<p class="help-block">:message</p>') !!}
        </div>

        <br>
        <div class="{{ $errors->has('is_call') ? 'has-error' : ''}}">
            {{ Form::checkbox('is_call', 1, ($opportunity->is_call == '1') ? true : false, ['class' => 'filled-in chk-col-deep-orange', 'id' => 'is_call']) }}
            {{Form::label("is_call", "Volunteer Should Call for Details:") }}
        </div>
    </div>
</div>



<br>
<br>
<h4>Opportunity Subject Area(s):</h4>
<hr>
<div class="row">
    <div class="col-sm-3">
        {{ Form::checkbox('subject1', 1, ($opportunity->subject1 == '1') ? true : false, ['class' => 'filled-in chk-col-deep-orange', 'id' => 'subject1']) }}
        {{Form::label("subject1", ucfirst("subject1")) }}<br>
    </div>
    <div class="col-sm-3">
        {{ Form::checkbox('subject2', 1, ($opportunity->subject2 == '1') ? true : false, ['class' => 'filled-in chk-col-deep-orange', 'id' => 'subject2']) }}
        {{Form::label("subject2", ucfirst("subject2")) }}<br>
    </div>
    <div class="col-sm-3">
        {{ Form::checkbox('subject3', 1, ($opportunity->subject3 == '1') ? true : false, ['class' => 'filled-in chk-col-deep-orange', 'id' => 'subject3']) }}
        {{Form::label("subject3", ucfirst("subject3")) }}<br>
    </div>
    <div class="col-sm-3">
        {{ Form::checkbox('subject4', 1, ($opportunity->subject4 == '1') ? true : false, ['class' => 'filled-in chk-col-deep-orange', 'id' => 'subject4']) }}
        {{Form::label("subject4", ucfirst("subject4")) }}<br>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        {{ Form::checkbox('subject5', 1, ($opportunity->subject5 == '1') ? true : false, ['class' => 'filled-in chk-col-deep-orange', 'id' => 'subject5']) }}
        {{Form::label("subject5", ucfirst("subject5")) }}<br>
    </div>
    <div class="col-sm-3">
        {{ Form::checkbox('subject6', 1, ($opportunity->subject6 == '1') ? true : false, ['class' => 'filled-in chk-col-deep-orange', 'id' => 'subject6']) }}
        {{Form::label("subject6", ucfirst("subject6")) }}<br>
    </div>
    <div class="col-sm-3">
        {{ Form::checkbox('subject7', 1, ($opportunity->subject7 == '1') ? true : false, ['class' => 'filled-in chk-col-deep-orange', 'id' => 'subject7']) }}
        {{Form::label("subject7", ucfirst("subject7")) }}<br>
    </div>
    <div class="col-sm-3">
        {{ Form::checkbox('subject8', 1, ($opportunity->subject8 == '1') ? true : false, ['class' => 'filled-in chk-col-deep-orange', 'id' => 'subject8']) }}
        {{Form::label("subject8", ucfirst("subject8")) }}<br>
    </div>
</div>

<br>
<br>
<h4>Task:</h4>
<hr>
<div class="row" id="task-div">
    @foreach($tasks as $task)
        <div class="col-sm-12">
            {!! Form::text('tasks[]', $task->description, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <button type="button" class="btn bg-red btn-block btn-lg waves-effect" id="add-more-task">Add More task</button>
    </div>
</div>

{!! Form::hidden('is_published', '0')!!}
<div class="row">
    <div class="col-sm-12 text-right">
        <button type="button" class="btn btn-primary btn-lg submit-opportunity" id="0">SAVE Opportunity</button>
        <button type="button" class="btn btn-primary btn-lg submit-opportunity" id="1">POST Opportunity</button>
    </div>
</div>