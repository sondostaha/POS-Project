
@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card mt-30">
                <div class="card-body">

                    <canvas id="myChart"></canvas>

                </div>
        </div>
    </div>
</div>






<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

var chartData = @json($chartData); // Assuming $chartData is defined in your controller

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar', // You can choose different chart types (pie, line, etc.)
    data: chartData,
    options: {
        responsive: true, // Makes the chart responsive to different screen sizes
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true, // Ensures the y-axis starts at zero
                    scaleLabel: 'إجمالي العمولة المكتسبة (جنيه مصري)' // Y-axis label in Arabic
                }
            }]
        }
    }
});
       
</script>

@endsection
