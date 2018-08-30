@component('mail::message')
Hello ,
<br>
There is a new message for you related opportunity named <b>{{$opportunity->title}}</b> from the teacher. There message is given below:
<br>
<br>
<p>{{$message}}</p>
<br>

<p>Click this link to for more detail about the opportunity: <a href="{{url('/opportunities/decision/'.$id)}}">{{url('/opportunities/decision/'.$id)}}</a> </p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
