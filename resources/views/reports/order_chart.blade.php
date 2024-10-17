
@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card mt-30">
                <div class="card-body">
                    <h2>{{ $title }}</h2>
                    <p>{{ $description }}</p>
                    <div style="width: 75%; margin: auto;">
                        <canvas id="ordersChart"></canvas>
                    </div>
                    
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th>المجال</th>
                                <th>عدد الطلبات</th>
                                <th>النسبة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderData as $data)
                            <tr>
                                <td>{{ $data['main_field_title'] }}</td>
                                <td>{{ $data['total_orders'] }}</td>
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
    var ctx = document.getElementById('ordersChart').getContext('2d');
    var chartData = @json($chartData);
    var ordersChart = new Chart(ctx, {
        type: 'pie',
        data: chartData,
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
                            text: 'عدد الطلبات في كل مجال'
                        }
                    }
                }
    });
</script>
@endsection
