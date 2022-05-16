<div class="col-lg-3 col-md-12">
    <div class="dashboard_chat_area">
        <h5>Patients</h5>
        <hr>
        <canvas id="myChart" width="400" height="400"></canvas>
        <p>Total Evaluated Patients</p>
    </div>
</div>
@section('script')
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Total Evaluated Patients',
            data: [{{$male}},{{$female}}],
            backgroundColor: [
                'MediumVioletRed',
                'Indigo',
            ],
            borderColor: [
                'MediumVioletRed',
                'Indigo',
            ],
            borderWidth: 1
        }]
    },
    options: {
         responsive: true,
    }
});
</script>
@endsection
