@component('mail::message')
# Hi
<h1>Welcome To Medicare</h1>
{!!$message!!}

@component('mail::button', ['url' => '','color'=>'green'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
