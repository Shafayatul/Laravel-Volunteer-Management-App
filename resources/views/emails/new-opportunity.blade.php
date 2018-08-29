@component('mail::message')
Hello ,
<br>
A New Volunteer Opportunity is available.
<br>
<br>
<p>Date of Opportunity: {{$opportunity->date}}</p>
<p>Time: {{$opportunity->start_time}} - {{$opportunity->end_time}}</p>
<p>School: {{$teacher_name}}</p>
<p>Teacher: {{$school_name}}</p>
<p>Click this link to commit to this opportunity: <a href="{{url('/opportunities/decision/'.$id)}}">{{url('/opportunities/decision/'.$id)}}</a> </p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
