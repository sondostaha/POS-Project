@section('title', $title)
@section('description', $description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.edit_order') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>الطلبات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.edit_order') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <div class="card card-Vertical card-default card-md mb-4">
                <div class="card-header">
                    <h6>{{ trans('menu.edit_order') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    <form action="{{ route('update_order', [app()->getLocale(), $order->id]) }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-25">
                                <div class="dm-select">
                                    <select name="client_id" class="form-control select2" data-placeholder="اختر عميل...">
                                        <option value="">العميل</option>
                                        @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" {{ $order->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-25">
                                <input placeholder="وقت التسليم" name="deadline" class="textbox-n form-control ih-medium ip-gray radius-xs b-light px-15" type="datetime-local" value="{{ $order->deadline }}" id="date" />
                            </div>

                            <div class="col-md-6 mb-25">
                                <select name="main_field_id" class="form-control px-15 select2" data-placeholder="اختر مجال العمل الرئيسي...">
                                    <option value=""></option>
                                    @foreach ($main_fields as $field)
                                    <option value="{{ $field->id }}" {{ $order->main_field_id == $field->id ? 'selected' : '' }}>{{ $field->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-25">
                                <select name="sub_field_id" class="form-control px-15 select2" data-placeholder="اختر مجال العمل الفرعي...">
                                    <option value=""></option>
                                    @foreach ($sub_fields as $sub_field)
                                    <option value="{{ $sub_field->id }}" {{ $order->sub_field_id == $sub_field->id ? 'selected' : '' }}>{{ $sub_field->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 mb-25">
                                <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" placeholder="الملاحظات" rows="3">{{ $order->desc }}</textarea>
                            </div>

                            <p class="text-danger fw-600">قيمة الطلب:</p>

                            <div class="col-md-6 mb-25">
                                <input type="text" name="cvalue" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="للعميل" value="{{ $order->cvalue }}">
                            </div>
{{--                            <div class="col-md-6 mb-25">--}}
{{--                                <input type="text" name="fvalue" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="للمستقل" value="{{ $order->fvalue }}">--}}
{{--                            </div>--}}

                            <p class="text-danger fw-600">حاله الطلب:</p>
                            <div class="col-md-6 mb-25">
                                <div class="dm-select">
                                    <select name="status" class="form-control select2" data-placeholder="..اختر بيانات التحويل">
                                        <option value=""></option>
                                        <option value="جاري" {{ $order->status == 'جاري' ? 'selected' : '' }}>جاري</option>
                                        <option value="مسلم" {{ $order->status == 'مسلم' ? 'selected' : '' }}>مسلم</option>
                                        <option value="قيدالمراجعه او التعديل" {{ $order->status == 'قيدالمراجعه او التعديل' ? 'selected' : '' }}>قيدالمراجعه او التعديل</option>
                                        <option value="افتراضي" {{ $order->status == 'افتراضي' ? 'selected' : '' }}>افتراضي</option>
                                        <option value="ملغي" {{ $order->status == 'ملغي' ? 'selected' : '' }}>ملغي</option>

                                    </select>
                                </div>
                            </div>
                            <p class="text-danger fw-600">بيانات التحويل:</p>

                            <div class="col-md-6 mb-25">
                                <div class="dm-select">
                                    <select name="method" class="form-control select2" data-placeholder="..اختر بيانات التحويل">
                                        <option value=""></option>
                                        <option value="لم يحول بعد" {{ $order->method == 'لم يحول بعد' ? 'selected' : '' }}>لم يحول بعد</option>
                                        <option value="ويسترن يونيون" {{ $order->method == 'ويسترن يونيون' ? 'selected' : '' }}>ويسترن يونيون</option>
                                        <option value="الراجحي" {{ $order->method == 'الراجحي' ? 'selected' : '' }}>الراجحي</option>
                                        <option value="انستا باي" {{ $order->method == 'انستا باي' ? 'selected' : '' }}>انستا باي</option>
                                        <option value="فودافون كاش" {{ $order->method == 'فودافون كاش' ? 'selected' : '' }}>فودافون كاش</option>
                                        <option value="حوالة بنكية" {{ $order->method == 'حوالة بنكية' ? 'selected' : '' }}>حوالة بنكية</option>
                                        <option value="باي بال" {{ $order->method == 'باي بال' ? 'selected' : '' }}>باي بال</option>
                                        <option value="مقابلة شخصية" {{ $order->method == 'مقابلة شخصية' ? 'selected' : '' }}>مقابلة شخصية</option>
                                        <option value="حوالة مجمعة" {{ $order->method == 'حوالة مجمعة' ? 'selected' : '' }}>حوالة مجمعة</option>
                                        <option value="مقابلة شخصية" {{ $order->method == 'مقابلة شخصية' ? 'selected' : '' }}>مقابلة شخصية</option>


                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-25">
                                <input type="text" name="proof" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="إثبات التحويل" value="{{ $order->proof }}">
                            </div>

                            <p class="text-danger fw-600">مستقل/مستقلين الطلب:</p>

                            <div class="container mt-3" id="freelancer-container">
                                @foreach (json_decode($order->freelancer_details, true) as $freelancerDetail)
                                <div class="row freelancer-row">
                                    <div class="col-md-6 mb-25">
                                        <div class="form-group select-px-15 tagSelect-rtl">
                                            <div class="dm-select">
                                                <select class="select2 form-control" name="freelancers[]" data-placeholder="اختر مستقل...">
                                                    <option value="">اختر</option>

                                                    @foreach ($freelancers as $freelancer)
                                                    <option value="{{ $freelancer->name }}" {{ $freelancerDetail['name'] == $freelancer->name ? 'selected' : '' }}>{{ $freelancer->name }}</option>
                                                        <option value="{{ $freelancer->name }}" >{{ $freelancer->name }}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-25">
                                        <input type="text" name="recieve[]" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="Amount in dollars" value="{{ $freelancerDetail['compensation'] }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>




                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-primary" id="add-freelancer-btn">+</button>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    function initializeSelect2() {
                                        $('.select2').select2();
                                    }

                                    initializeSelect2();

                                    $('#add-freelancer-btn').on('click', function() {
                                        var container = $('#freelancer-container');
                                        var originalRow = $('.freelancer-row').first();
                                        var newRow = originalRow.clone();
                                        newRow.find('input').val('');
                                        newRow.find('.select2').remove();
                                        var selectHTML = `
                                            <select class="select2 form-control" name="freelancers[]" data-placeholder="اختر مستقل...">
                                                <option value="">اختر</option>
                                                @foreach ($freelancers as $freelancer)
                                                <option value="{{ $freelancer->name }}">{{ $freelancer->name }}</option>
                                                @endforeach
                                            </select>
                                        `;
                                        newRow.find('.dm-select').html(selectHTML);
                                        container.append(newRow);
                                        initializeSelect2();
                                    });
                                });
                            </script>

                            <div class="col-md-6">
                                <div class="layout-button mt-0">
                                    <button type="submit" class="btn btn-primary btn-default btn-squared px-30">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
