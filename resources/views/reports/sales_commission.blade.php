
@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card mt-30">
                <div class="card-body">

    <h2>تقرير مستحقات مسؤولي المبيعات بالفريق</h2>
    <p>قيمة إجمالي مستحقات مسؤولي المبيعات بالدولار (10% من الارباح): ${{ $totalEarnings }}</p>
    
    <canvas id="agentEarningsChart" width="400" height="400"></canvas>
    
    
                </div>
        </div>
    </div>
</div>






<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('agentEarningsChart').getContext('2d');
    var chartData = @json($chartData);
    
    console.log('Chart Data:', chartData);

    if (!Array.isArray(chartData) || chartData.length === 0) {
        console.error('Invalid or empty chart data');
        return;
    }

    var labels = chartData.map(item => item.label);
    var values = chartData.map(item => item.value);
    var percentages = chartData.map(item => item.percentage);

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                ]
            }]
        },
                        options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2,  // تعديل هذه القيمة لتغيير حجم الدائرة
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'مستحقات مسؤولي المبيعات في كل مجال'
                        }
                    }
                }
    });
});
</script>

@endsection
