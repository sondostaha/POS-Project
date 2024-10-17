@section('title', $title)
@section('description', $description)
@extends('layout.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card mt-30">
                <div class="card-body">

<div class="container" dir="rtl">
    <h1>{{ $title }}</h1>
    <div class="container" dir="ltr">
        <h3>تاريخ الجرد: {{ date_format($date, 'Y-m-d') }} </h3>
    </div>
    <p>{{ $description }}</p>

    <div class="row">
        <div class="col-md-6">
            <h2>نظرة عامة</h2>
            <p>إجمالي الإيرادات: {{ number_format($reportData['إجمالي الإيرادات'], 2) }} $</p>
            <p>صافي الربح: {{ number_format($reportData['صافي الربح'], 2) }} $</p>
        </div>
        <div class="col-md-6">
            <canvas id="profitOverviewChart"></canvas>
        </div>
    </div>

<div class="row mt-4">
    <div class="col-md-12">
        <h2 class="text-center mb-4">تفصيل المصروفات</h2>
    </div>
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
            <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>مستحقات المستقلين</span>
                                <span class="badge bg-primary rounded-pill">{{ number_format($reportData['مستحقات المستقلين'], 2) }} $</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>عمولة المسوقين بالعمولة </span>
                                <span class="badge bg-primary rounded-pill">{{ number_format($reportData['عمولة المسوقين بالعمولة'], 2) }} $</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span> عمولة وكيل المبيعات</span>
                                <span class="badge bg-primary rounded-pill">{{ number_format($reportData['عمولة وكيل المبيعات'], 2) }} $</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span> عمولة مسؤول المبيعات</span>
                                <span class="badge bg-primary rounded-pill">{{ number_format($reportData['عمولة مسؤول المبيعات'], 2) }} $</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span> اجمالي الميزانيات</span>
                                <span class="badge bg-primary rounded-pill">{{ number_format($reportData['اجمالي الميزانيات'], 2) }} $</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>مستحقات مدير المبيعات</span>
                                <span class="badge bg-primary rounded-pill">{{ number_format($reportData['مستحقات مدير المبيعات'], 2) }} $</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>مستحقات المدير التقني</span>
                                <span class="badge bg-primary rounded-pill">{{ number_format($reportData['مستحقات المدير التقني'], 2) }} $</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span> مستحقات المدير المالي</span>
                                <span class="badge bg-primary rounded-pill">{{ number_format($reportData['مستحقات المدير المالي'], 2) }} $</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>مستحقات المدير التنفيذي</span>
                                <span class="badge bg-primary rounded-pill">{{ number_format($reportData['مستحقات المدير التنفيذي'], 2) }} $</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>مستحقات مدير التسويق</span>
                                <span class="badge bg-primary rounded-pill">{{ number_format($reportData['مستحقات مدير التسويق'], 2) }} $</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>مستحقات مدير الموارد البشرية</span>
                                <span class="badge bg-primary rounded-pill">{{ number_format($reportData['مستحقات مدير الموارد البشرية'], 2) }} $</span>
                            </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <canvas id="expenseBreakdownChart"></canvas>
            </div>
        </div>
    </div>
</div>

    <div class="row mt-4">
        <div class="col-md-12">
            <h2>الإيرادات حسب المجال</h2>
            <canvas id="revenueByFieldChart"></canvas>
        </div>
    </div>
</div>
                </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // نظرة عامة على الربح
    new Chart(document.getElementById('profitOverviewChart'), {
        type: 'pie',
        data: {
            labels: Object.keys(@json($chartData['profitOverview'])),
            datasets: [{
                data: Object.values(@json($chartData['profitOverview'])),
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
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
                    text: 'نظرة عامة على الربح'
                }
            }
        }
    });

    // تفصيل المصروفات
    new Chart(document.getElementById('expenseBreakdownChart'), {
        type: 'bar',
        data: {
            labels: Object.keys(@json($chartData['expenseBreakdown'])),
            datasets: [{
                data: Object.values(@json($chartData['expenseBreakdown'])),
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                    '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: 'تفصيل المصروفات'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // الإيرادات حسب المجال
new Chart(document.getElementById('revenueByFieldChart'), {
    type: 'doughnut',
    data: {
        labels: @json($chartData['revenueByField']->pluck('title')),
        datasets: [{
            data: @json($chartData['revenueByField']->pluck('value')),
            backgroundColor: [
                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        aspectRatio: 2, // ةذا سيجعل الرسم البياني أصغر
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'الإيرادات حسب المجال'
            }
        }
    }
});</script>


@endsection
