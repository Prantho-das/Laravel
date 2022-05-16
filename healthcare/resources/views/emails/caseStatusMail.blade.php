@component('mail::message')
@if ($case->case_status===1)
<h1 style='align-items:center'>
    Hi Mr.{{$case->patientInfo->f_name}}, Your case is over, congratulation you are safe.
</h1>
@elseif($case->case_status===2)
<h1 style='align-items:center'>
    Hi Mr.{{$case->patientInfo->f_name}}, Your case is over, you are not safe. Your Case Is Uncleared
</h1>
@endif
<hr>
<h2>Doctor Name: <span style='color:royalblue'>{{$case->doctorInfo->f_name}} {{$case->doctorInfo->l_name}}</span></h2>
@component('mail::button', ['url' => 'patient/case_details/'.encrypt($case->case_id) ])
Go To Case
@endcomponent

{{-- @if (auth()->user()->role==='PATIENT') --}}
@if ($case->descriptionInfo)
Download Your Prescription
@component('mail::button', ['url' => URL::signedRoute('prescription', ['id' => $case->id])])
Prescription
@endcomponent
@endif
{{-- @endif --}}
@if ($case->prescription)
Prescription:{{URL::signedRoute('prescription',['id'=>$case->id])}}
@endif
<br/>
Case Details:{{url('patient/case_details/'.encrypt($case->case_id))}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
