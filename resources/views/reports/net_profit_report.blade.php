@section('title', $title)
@section('description', $description)
@extends('layout.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card mt-30">
                <div class="card-body">

<div class="container">
    <h1 class="mb-5">تقرير الأرباح الصافية</h1>

    <div class="row">
        <div class="col-md-6">
            <canvas id="profitChart"></canvas>
        </div>
        <div class="col-md-6">
            <h2>ملخص المالي</h2>
            <p>إجمالي الإيرادات: {{ number_format($totalRevenue, 2) }}</p>
            <p>إجمالي المصروفات: {{ number_format($totalExpenses, 2) }}</p>
            <p>الأرباح الصافية: {{ number_format($netProfit, 2) }}</p>
        </div>
    </div>

    <h2 class="mt-5">تفصيل المصروفات</h2>
    <table class="table">
        <thead>
            <tr>
                <th>البند</th>
                <th>القيمة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($breakdownData as $item => $value)
            <tr>
                <td>{{ $item }}</td>
                <td>{{ number_format($value, 2) }}</td>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('profitChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                label: 'القيمة بالدولار',
                data: {!! json_encode($chartData['data']) !!},
                backgroundColor: [
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                ]
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
                    text: 'ملخص الأرباح والخسائر'
                }
            }
        }
    });
</script>

@endsection
