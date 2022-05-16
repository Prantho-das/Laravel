@component('mail::message')
You Have Message From {{$message->full_name}}

@component('mail::button', ['url' => '/'])
Go to Home
@endcomponent
<h3>
    Subject:{{$message->subject}}
</h3>
<p>
{{$message->message}}
</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
