
@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card mt-30">
                <div class="card-body">

<div class="container">
    <h1>{{ $title }}</h1>
    <p>{{ $description }}</p>
    <h2>إجمالي قيمة ميزانية التطوير: {{ number_format($totalSalesManagerDues, 2) }}</h2>

    <div class="row">
        <div class="col-md-6">
            <canvas id="salesManagerDuesChart"></canvas>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>المجال</th>
                        <th>المستحقات</th>
                        <th>النسبة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chartData as $data)
                    <tr>
                        <td>{{ $data['label'] }}</td>
                        <td>{{ number_format($data['value'], 2) }}</td>
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
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('salesManagerDuesChart').getContext('2d');
    var salesManagerDuesChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_column($chartData, 'label')) !!},
            datasets: [{
                data: {!! json_encode(array_column($chartData, 'value')) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                ],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'قيمة ميزانية التطوير حسب كل مجال'
                }
            }
        }
    });
</script>

@endsection
