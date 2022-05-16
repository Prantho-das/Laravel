<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Healthcare | Prescription</title>
    <!-- Icons -->
    <link rel="shortcut icon" href="assets/media/favicons/favicon.png">
    <!-- END Icons -->
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <br>
    <center>
        <div style="width=842px" class="table-responsive table-responsive-sm table-responsive-lg table-responsive-md"
            style="overflow-x:auto;">
            <table width=842px height=auto cellpadding=20 cellspacing=0
                style="background-color: #fff; border: 1px solid #000">
                <tr width=100%>
                    <td width=35%>
                        <h1><i class="fas fa-user-md"></i> Medicare</h1>
                        <span><i class="fa fa-envelope"></i>
                            {{$data->assign_info->email?$data->assign_info->email:''}}</span><br>
                        <span><i class="fa fa-phone"></i> Contact
                            No.{{$data->assign_info->phone?$data->assign_info->phone:''}}</span><br>
                        <span><i class="fas fa-map-marked-alt"></i>
                            {{$data->assign_info->address?$data->assign_info->address:''}}</span><br>
                    </td>
                    <td width=65% style="background-color: #0096c7; color: #fff;">
                        <h3 style="color: #fff">{{$data->assign_info->f_name}}</h3>
                        @if ($data->assign_info)
                        <span>{{$data->assign_info->highest_degree_one?$data->assign_info->highest_degree_one:''}}</span>
                        <span>{{$data->assign_info->highest_degree_two?$data->assign_info->highest_degree_two:''}}</span>
                        <span>{{$data->assign_info->highest_degree_three?$data->assign_info->highest_degree_three:''}}</span>
                        <span>{{$data->assign_info->highest_degree_four?$data->assign_info->highest_degree_four:''}}</span>
                        <span>{{$data->assign_info->specilization?$data->assign_info->specilization:''}}</span>
                        @endif
                    </td>
                </tr>
                <table width=842px height=auto cellpadding=5 cellspacing=0>
                    <tr width=100%>
                        <td width=100% style="background-color: #0096c7;"></td>
                    </tr>
                </table>
                <table border="1" width=842px height=auto cellpadding=5 cellspacing=0>
                    <tr>
                        <td height=100px style="width: 350px; padding-left: 15px;">
                            <h4>Patient Information: </h4>
                            <hr style="border-bottom: 1px solid #0096c7; margin:0px !important">
                            <span>Name:{{$patient->f_name}} </span>
                            <hr style="border-bottom: 1px solid #0096c7; margin:0px !important">
                            <span>Age:{{$patient->age?\Carbon\Carbon::make($patient->age)->age:"Not Filled Up"}}</span>
                            <hr style="border-bottom: 1px solid #0096c7; margin:0px !important">
                            <span>Gender:{{$patient->gender?$patient->gender:"Not Filled Up"}} </span>
                            <hr style="border-bottom: 1px solid #0096c7; margin:0px !important">
                            <span>Prescribe Date: {{$data->created_at?$data->created_at:'N/A'}}</span>
                            <hr style="border-bottom: 1px solid #0096c7; margin:0px !important"><br><br>
                            <!--desises-->
                            <h4>Symptoms/Diseses: </h4>
                            <hr style="border-bottom: 1px solid #0096c7; margin:0px !important">
                            {!!$data->disease!!}
                        </td>
                        <td width=65% style="background-color: #fff; color: #000;">
                            <h2 style="padding-left: 15px">R<sub>x</sub></h2><br>
                            <div style="padding-left: 10%">
                                {!!$data->medicine!!}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left: 15px;">
                        </td>
                        <td style="padding-left: 15px;">
                            Note: {!!$data->note!!}
                        </td>
                    </tr>
                </table>
            </table>
        </div><br>
    </center>
    <!-- Footer -->
    <footer id="page-footer">
        <div class="content py-3">
            <div class="row font-size-sm">
                <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                    Crafted with <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="#"
                        target="_blank">Healthcare</a>
                </div>
                <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
                    <a class="font-w600" href="#" target="_blank">Healthcare</a> &copy; <span
                        data-toggle="year-copy"></span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
