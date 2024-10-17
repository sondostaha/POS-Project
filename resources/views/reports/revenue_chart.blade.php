
@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card mt-30">
                <div class="card-body">

<h2>تقرير إيرادات الشركة</h2>
    <p>قيمة إجمالي إيرادات الحركة للشركة بالدولار: ${{ $totalRevenue }}</p>
    
    <canvas id="revenueChart" width="400" height="400"></canvas>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>المجال</th>
                <th>الإيرادات</th>
                <th>النسبة المئوية</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chartData as $data)
            <tr>
                <td>{{ $data['label'] }}</td>
                <td>${{ $data['value'] }}</td>
                <td>{{ $data['percentage'] }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>               
                    </div>
            </div>
        </div>
    </div>
</div>






<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var chartData = @json($chartData);
    
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
                    'rgba(255, 159, 64, 0.8)'
                ]
            }]
        },
                        options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2,  // تعديل ةذة القيمة لتغيير حجم الدائرة
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'الإيرادات في كل مجال'
                        }
                    }
                }
    });
});
</script>

@endsection
