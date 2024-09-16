@section('title', $title)
@section('description', $description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card mt-30">
                <div class="card-body">
                    <h2 class="mb-4">تقرير المسوقين بالعمولة</h2>
                    <h3>إجمالي العمولات: {{ number_format($totalCommissionSum, 2) }}</h3>
                    
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>اسم المسوق</th>
                                <th>العميل المحال</th>
                                <th>عدد الطلبات</th>
                                <th>إجمالي العمولة</th>
                                <th>نسبة من الإجمالي</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commissionData as $data)
                            <tr>
                                <td>{{ $data['name'] }}</td>
                                <td>{{ $data['existingClientName'] }}</td>
                                <td>{{ $data['orderCount'] }}</td>
                                <td>{{ number_format($data['commission'], 2) }}</td>
                                <td>{{ number_format(($data['commission'] / $totalCommissionSum) * 100, 2) }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="mt-5">تفاصيل العمولات لكل عميل</h3>
                    @foreach($commissionData as $data)
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4>{{ $data['name'] }} ({{ $data['existingClientName'] }})</h4>
                        </div>
                        <div class="card-body">
                            <p>عدد الطلبات: {{ $data['orderCount'] }}</p>
                            <p>إجمالي العمولة: {{ number_format($data['commission'], 2) }}</p>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>رقم الطلب</th>
                                        <th>العمولة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['orders'] as $index => $orderId)
                                    <tr>
                                        <td>{{ $orderId }}</td>
                                        <td>{{ number_format($data['commissions'][$index], 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection