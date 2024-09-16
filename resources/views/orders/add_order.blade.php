<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.add_order') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>الطلبات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.add_order') }}</li>
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
                    <h6>{{ trans('menu.add_order') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    <form action="{{ route('store_order', app()->getLocale()) }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-25">

                                    <div class="dm-select">

                                        <select name="client_id" class="form-control select2" data-placeholder="اختر عميل...">
                                            <option value="">العميل</option>
                                            @foreach ($clients as $client )
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>


                            </div>

                            <div class="col-md-6 mb-25">

                                <input placeholder="وقت التسليم" name="deadline" class="textbox-n form-control ih-medium ip-gray radius-xs b-light px-15" type="text" onfocus="(this.type='datetime-local')" onblur="(this.type='datetime-local')" id="date" />
                            </div>

                            <div class="col-md-6 mb-25">
                                <select name="main_field_id" class="form-control px-15 select2" data-placeholder="اختر مجال العمل الرئيسي...">
                                    <option value=""></option>
                                    @foreach ($main_fields as $field )

                                    <option value="{{$field->id}}">{{$field->title}}</option>


                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-6 mb-25">
                                <select name="sub_field_id" class="form-control px-15 select2 " data-placeholder="اختر مجال العمل الفرعي...">
                                    <option value=""></option>
                                    @foreach ($sub_fields as $sub_field )

                                    <option value="{{$sub_field->id}}">{{$sub_field->title}}</option>


                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-12 mb-25">
                                <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" placeholder="وصف الطلب" rows="3"></textarea>
                            </div>


                            <p style="color:#000;font-weight: bolder;">قيمة الطلب:</p>

                            <div class="col-md-6 mb-25">
                                <input type="text" name="cvalue" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="للعميل" value="">
                            </div>
{{--                            <div class="col-md-6 mb-25">--}}
{{--                                <input type="text" name="fvalue" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="للمستقل" value="">--}}
{{--                            </div>--}}

                            <p style="color:#000;font-weight: bolder;"> بيانات التحويل:</p>

                            <div class="col-md-6 mb-25">

                                <div class="dm-select">

                                    <select name="method" class="form-control select2 " data-placeholder="..اختر بيانات التحويل">
                                        <option value=""></option>
                                        <option value="لم يحول بعد">لم يحول بعد</option>
                                        <option value="ويسترن يونيون">ويسترن يونيون</option>
                                        <option value="انستا باي">انستا باي</option>
                                        <option value="ماني جرام">ماني جرام </option>
                                        <option value="حوالة مجمعة">حوالة مجمعة</option>
                                        <option value="محلية سعودية">محلية سعودية</option>
                                        <option value="فودافون كاش">فودافون كاش</option>
                                        <option value="حوالة بنكية">حوالة بنكية</option>
                                        <option value="باي بال">باي بال</option>
                                        <option value="مقابلة شخصية">مقابلة شخصية</option>
                                    </select>

                                </div>

                            </div>


                        <div class="col-md-6 mb-25">
                            <input type="text" name="proof" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="إثبات التحويل" value="">
                        </div>

                        <p style="color:#000;font-weight: bolder;"> مستقل/مستقلين الطلب:</p>


                        <div class="container mt-3" id="freelancer-container">
                            <div class="row freelancer-row">
                                <div class="col-md-6 mb-25">
                                    <div class="form-group select-px-15 tagSelect-rtl">
                                        <div class="dm-select">
                                            <select class="select2 form-control" name="freelancers[]" data-placeholder="اختر مستقل...">
                                                <option value="">اختر</option>
                                                @foreach ($freelancers as $freelancer)
                                                <option value="{{$freelancer->name}}">{{$freelancer->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-25">
                                    <input type="text" name="recieve[]" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="القيمة بالدولار" value="">
                                </div>
                            </div>
                        </div>

                        <div class="text-center" style="margin-top: -30px;">
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
                                        <select class="select2 form-control" name="freelancers[]" data-placeholder="اختر ...">
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


                            <div class="col-md-6 mt-5">
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

