@component('mail::message')
Hello ,
<br>
You request for the opportunity named <b>{{$opportunity->title}}</b> has been approved.
<br>
<br>
<p>Date of Opportunity: {{$opportunity->date}}</p>
<p>Time: {{$opportunity->start_time}} - {{$opportunity->end_time}}</p>
<p>Click this link to for more detail: <a href="{{url('/opportunities/decision/'.$id)}}">{{url('/opportunities/decision/'.$id)}}</a> </p>
<p>Message from the teacher:</p>
<hr>
<p>{{$message}}</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
