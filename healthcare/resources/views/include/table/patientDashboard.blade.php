@if ($case->assignCase)
<tr>
    <td>
        <b class='text-center'>
            {{$loop->iteration}}
        </b>
    </td>

    <td>
        {{\Carbon\Carbon::parse($case->created_at)->format('H:iA, d/m/Y')}}
    </td>
    <td>
        {{\Carbon\Carbon::parse($case->updated_at)->format('H:iA, d/m/Y')}}
    </td>
    <td>
        {{$case->assignCase->release_date?(\Carbon\Carbon::parse($case->assignCase->release_date)->format('H:iA, d/m/Y')):'Running'}}
    </td>
    <td>{{$case->assignCase->f_name}} {{$case->assignCase->l_name}}</td>

    <td>
        @if ($case->assignCase->case_status===0)
        <a href="{{url('patient/case_details/'.encrypt($case->id))}}" class="btn btn-sm btn-info">
            Running
        </a>
        @elseif($case->assignCase->case_status===1)
        <a href="{{url('patient/case_details/'.encrypt($case->id))}}" class="btn btn-sm btn-success">
            Safe
        </a>
        @elseif($case->assignCase->case_status===2)
        <a href="{{url('patient/case_details/'.encrypt($case->id))}}" class="btn btn-sm btn-danger">
            Unclear
        </a>
        @endif
    </td>
</tr>
@else
<tr>
    <td>
        <b class='text-center'>
            {{$loop->iteration}}
        </b>
    </td>
    <td>{{\Carbon\Carbon::parse($case->created_at)->format('H:iA, d/m/Y')}}</td>
    <td>Not Assigned Yet</td>
    <td>Not Assigned Yet</td>
    <td>Not Assigned Yet</td>
    <td>
        @if ($case->payment_status===0)
        <a href="{{url('patient/case_details/'.encrypt($case->id))}}" class="btn btn-sm btn-secondary">
            Pay Now
        </a>
        @elseif($case->payment_status===1)
        <a href="{{url('patient/case_details/'.encrypt($case->id))}}" class="btn btn-sm btn-info">
            Pending
        </a>
        @endif
    </td>
</tr>
@endif
