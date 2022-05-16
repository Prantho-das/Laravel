@extends('layouts.appMain')
@section('title')
Prescription
@endsection
@section('navbar')
@if (Auth::user()->role === "ADMIN")
@include('include.adminNav')
@elseif(Auth::user()->role === "PATIENT")
@include('include.patientNav')
@elseif(Auth::user()->role === "DOCTOR")
@include('include.doctorNav')
@endif
@endsection
@section('main')
<br>
<br>
<br><br>
<center>

    <div style="width=842px"
        class="table-responsive table-responsive-sm table-responsive-lg table-responsive-md print"
        style="overflow-x:auto;">
        <table width=842px height=auto cellpadding=20 cellspacing=0
            style="background-color: #fff;">
            <tr width=100%>
                <td width=35%>
                    @include('include.logo')
                    {{-- <span style="padding-left: 10px">{{$setting->email?$setting->email:''}}</span><br>
                    <span style="padding-left: 10px">{{$setting->contact?$setting->contact:''}}</span><br>
                    <span style="padding-left: 10px">{{$setting->address?$setting->address:''}}</span><br> --}}
                    <span style="padding-left: 10px">{{$setting->email?$setting->email:''}}</span><br>
                    @forelse ($setting->contact as $item)
                    <span style="padding-left: 10px">{{$item}}
                    </span><br>
                    @empty

                    @endforelse
                    <span style="padding-left: 10px">{{$setting->address?$setting->address:''}}</span><br>
                </td>
                <td width=65% style="background-color: #0096c7; color: #fff;">

                    <h3 style="color: #fff">{{$data->assign_info->f_name}} {{$data->assign_info->l_name}}</h3>
                    @if ($data->assign_info)
                    <b>Specialist : <span>{{$data->assign_info->specilization?$data->assign_info->specilization:''}}</span></b><br>
                    <span>{{$data->assign_info->highest_degree_one?$data->assign_info->highest_degree_one:''}},</span>
                    <span>{{$data->assign_info->highest_degree_two?$data->assign_info->highest_degree_two:''}},</span>
                    <span>{{$data->assign_info->highest_degree_three?$data->assign_info->highest_degree_three:''}},</span>
                    <span>{{$data->assign_info->highest_degree_four?$data->assign_info->highest_degree_four:''}}</span><br>
                    <span>{{$data->assign_info->email?$data->assign_info->email:''}}, {{$data->assign_info->phone?$data->assign_info->phone:''}}</span></span><br>
                    @endif
                </td>
            </tr>

            <table width=842px height=auto cellpadding=5 cellspacing=0>
                <tr width=100%>
                    <td width=100% style="background-color: #0096c7;"></td>
                </tr>
            </table>

            <table style="border:1px solid #fff" width=842px height=auto cellpadding=5 cellspacing=0>
                <tr>
                    <td height=100px style="border-right: 1px solid #0096c7; background-color: #f3f3f3;width: 350px; padding-left: 15px;">
                        <h4>Patient Information: </h4>
                        <hr style="border-bottom: 1px solid #0096c7; margin:0px !important">
                        <span>Name: {{$patient->f_name}} </span>
                        <hr style="border-bottom: 1px solid #0096c7; margin:0px !important">
                        <span>Age: {{$patient->age?\Carbon\Carbon::make($patient->age)->age:"Not Filled Up"}}</span>
                        <hr style="border-bottom: 1px solid #0096c7; margin:0px !important">
                        <span>Gender: {{$patient->gender?$patient->gender:"Not Filled Up"}} </span>
                        <hr style="border-bottom: 1px solid #0096c7; margin:0px !important">
                        <span>Prescribe Date: {{$data->created_at?$data->created_at:'N/A'}}</span>
                        <hr style="border-bottom: 1px solid #0096c7; margin:0px !important"><br><br>
                        <!--desises-->
                        <h4>Symptoms/Diseses: </h4 <hr style="border-bottom: 1px solid #0096c7; margin:0px !important">
                        {!!$data->disease!!}
                    </td>
                    <td width=65% height=100px style="background-color: #fff; color: #000;">
                        <h2 style="padding-left: 15px">R<sub>x</sub></h2><br>
                        <div style="padding-left: 10%">
                            {!!$data->medicine!!}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #f3f3f3;padding-left: 15px;">

                    </td>
                    <td style="border: 1px solid #0096c7; border-left: 1px solid #0096c7; background-color: #f3f3f3;padding-left: 15px;">Note: {!!trim($data->note)!!}</td>
                </tr>
            </table>
        </table>
    </div><br>
    <button style="width: 85px; background-color: #e9e9e9;" class="form-control" id="printPageButton" onclick="window.print()"><i
            class="si si-printer"></i> Print</button>
            <br><br><br>
</center>
@endsection
