@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.edit_clients') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>العملاء</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.edit_clients') }}</li>
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
                    <h6>{{ trans('menu.edit_clients') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    <form action="{{route('update_clients', [app()->getLocale() , $client->id])}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-25">
                                <input type="text" name="name" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="اسم العميل" value="{{$client->name}}">
                            </div>

                            <div class="col-md-6 mb-25">
                                <input type="text" name="email" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="البريد الإلكتروني" value="{{$client->email}}">
                            </div>

                            <div class="col-md-6 mb-25">
                                <select name="user_id" id="countryOption7" class="form-control px-15 ">
                                    <option value=""></option>
                                    @foreach ($sellers as $seller )

                                    <option value="{{$seller->id}}" {{$client->user_id == $seller->id ? 'selected' : ''}} >{{$seller->name}}</option>


                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="col-md-6 mb-25">
                                <input type="text" name="phone" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="رقم الموبايل" value="{{$client->phone}}">
                            </div>

                            <div class="col-md-6 mb-25">

                                    <div class="dm-select">

                                        <select name="country" id="select-alerts2" class="form-control ">
                                            <option value="">الدولة</option>
    @foreach($countries as $country)
        <option value="{{ $country->name_ar }}" {{ $client->country == $country->name_ar ? 'selected' : '' }}>
            {{ $country->name_ar }} / {{ $country->name_en }}
        </option>
    @endforeach
                                        </select>

                                    </div>

                            </div>
                            <div class="col-md-6 mb-25">
                                <select class="form-control text-end" id="countryOption" name="gender" required>
                                    <option value="">الجنس</option>
                                    @if ($client->gender == "ذكر")
                                    <option value="ذكر" selected>ذكر</option>
                                    <option value="أنثي">أنثي</option>
                                    @else
                                    <option value="ذكر" >ذكر</option>
                                    <option value="أنثي" selected>أنثي</option>

                                    @endif
                                </select>
                            </div>

                            <div class="col-md-6 mb-25">
                                        <select name="what" id="countryOption2" class="form-control">
                                            <option value="">الماةية</option>
                                            @if ($client->what == "فرد")

                                            <option value="فرد" selected>فرد</option>
                                            <option value="شركة">شركة</option>
                                            <option value="وسيط">وسيط</option>
                                                
                                            @elseif($client->what == "شركة")
                                            <option value="فرد" >فرد</option>
                                            <option value="شركة" selected>شركة</option>
                                            <option value="وسيط">وسيط</option>

                                            @else

                                            <option value="فرد">فرد</option>
                                            <option value="شركة">شركة</option>
                                            <option value="وسيط" selected >وسيط</option>
                                                
                                            @endif
                                            
                                        
                                        </select>
                            </div>

                            <div class="col-md-6 mb-25">
                                        <select name="source" id="countryOption3" class="form-control px-15 ">
                                            <option value="">المصدر</option>
                                            @if ($client->source == "الفرانشيز")

                                            <option value="الفرانشيز" selected>الفرانشيز</option>
                                            <option value="المسؤول">المسؤول</option>
                                            <option value="الوكيل">الوكيل</option>
                                                
                                            @elseif($client->source == "لمسؤول")

                                            <option value="الفرانشيز">الفرانشيز</option>
                                            <option value="المسؤول" selected>المسؤول</option>
                                            <option value="الوكيل">الوكيل</option>

                                            @else

                                            <option value="الفرانشيز">الفرانشيز</option>
                                            <option value="المسؤول" >المسؤول</option>
                                            <option value="الوكيل" selected>الوكيل</option>


                                                
                                            @endif
                                            
                                        
                                        </select>
                            </div>

                            <div class="col-md-6 mb-25">
                                        <select name="important" id="countryOption4" class="form-control px-15 ">
                                            <option value="">الأةمية</option>
                                            @if($client->important == "1")
                                            <option selected value="1">1</option>
                                            @elseif($client->important == "2")
                                            <option selected value="2">2</option>
                                            @elseif($client->important == "3")
                                            <option selected value="3">3</option>
                                            @elseif($client->important == "4")
                                            <option selected value="4">4</option>
                                            @elseif($client->important == "5")
                                            <option selected value="5">5</option>
                                            @elseif($client->important == "6")
                                            <option selected value="6">6</option>
                                            @elseif($client->important == "7")
                                            <option selected value="7">7</option>
                                            @elseif($client->important == "8")
                                            <option selected value="8">8</option>
                                            @elseif($client->important == "9")
                                            <option selected value="9">9</option>
                                            @elseif($client->important == "10")
                                            <option selected value="10">10</option>
                                            
                                            @endif
                                        </select>
                            </div>

                            <div class="col-md-6 mb-25">
                                <select name="main_field_id" id="countryOption5" class="form-control px-15 ">
                                    <option value="">المجال الابتدائي لطلب العميل</option>

                                    @foreach ($main_fields as $field )

                                    <option value="{{$field->id}}" {{$client->main_field_id == $field->id ? 'selected' : ''}}>{{$field->title}}</option>

                                        
                                    @endforeach                                    
                                </select>
                            </div>

                            <div class="col-md-6 mb-25">
                                <textarea name="notes" class="form-control" id="exampleFormControlTextarea1" placeholder="الملاحظات" rows="3">{{$client->notes}}</textarea>
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
@endsection