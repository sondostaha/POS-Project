@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.add_clients') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>العملاء</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.add_clients') }}</li>
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
                    <h6>{{ trans('menu.add_clients') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    <form action="{{route('store_clients', app()->getLocale())}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-25">
                                <input type="text" name="name" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="اسم العميل" value="{{old('name')}}">
                            </div>

                            <div class="col-md-6 mb-25">
                                <input type="text" name="email" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="البريد الإلكتروني" value="{{old('email')}}">
                            </div>

                            <div class="col-md-6 mb-25">
                                <select name="user_id" id="countryOption7" class="form-control px-15 ">
                                    <option value=""></option>
                                    @foreach ($sellers as $seller )
                                    <option value="{{$seller->id}}">{{$seller->name}}</option>

                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-6 mb-25">
                                <input type="text" id="phone" name="phone" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="رقم الموبايل" value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-6 mb-25">
                                <div class="dm-select">
                                    <select name="country" id="select-alerts2" class="country form-control ">
                                        <option value="">الدولة</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->name_ar }}">{{ $country->name_ar }} / {{ $country->name_en }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-25">
                                <select class="form-control text-end" id="countryOption" name="gender" required>
                                    <option value="">الجنس</option>
                                    <option value="ذكر">ذكر</option>
                                    <option value="أنثي">أنثي</option>
                                </select>
                            </div>

    <div class="col-md-6 mb-25">
        <select name="what" id="countryOption2" class="form-control">
            <option value="" >الماةية</option>
            <option value="فرد" >فرد</option>
            <option value="شركة" >شركة</option>
            <option value="وسيط" >وسيط</option>

        </select>
</div>

<div class="col-md-6 mb-25">
        <select name="source" id="countryOption3" class="form-control px-15 ">
            <option value="">المصدر</option>
            <option value="الفرانشيز" >الفرانشيز</option>
            <option value="المسؤول" >المسؤول</option>
            <option value="الوكيل" >الوكيل</option>

        </select>
</div>

                            <div class="col-md-6 mb-25">
                                        <select name="important" id="countryOption4" class="form-control px-15 ">
                                            <option value="">الأةمية</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                            </div>

                            <div class="col-md-6 mb-25">
                                <select name="main_field_id" id="countryOption5" class="form-control px-15 ">
                                    <option value="">المجال الابتدائي لطلب العميل</option>
                                    @foreach ($main_fields as $field )

                                    <option value="{{$field->id}}">{{$field->title}}</option>


                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-6 mb-25">
                                <textarea name="notes" class="form-control" id="exampleFormControlTextarea1" placeholder="الملاحظات" rows="3"></textarea>
                            </div>



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



<script src="{{asset('js/country_code.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
        $(document).ready(function() {
        $('#select-alerts2').change(function() {
            let selectedCountry = $(this).val();
            let countryCode = countryCodes[selectedCountry] || '';
            $('#phone').val(countryCode);
        });
    });
</script>


@endsection
