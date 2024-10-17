@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.edit-freelancer') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>المستقلين</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.edit-freelancer') }}</li>
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
                    <h6>{{ trans('menu.edit-freelancer') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    <form action="{{route('update_freelancer' , [app()->getLocale() , $freelancer->id])}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-25">
                                <input type="text" name="name" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="الأسم ثلاثي" value="{{$freelancer->name}}">
                            </div>
                            <div class="col-md-6 mb-25">
                                <input type="text" name="age" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="السن" value="{{$freelancer->age}}">
                            </div>
                            <div class="col-md-6 mb-25">
                                <input type="text" name="country" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="البلد" value="{{$freelancer->country}}">
                            </div>
                            <div class="col-md-6 mb-25">
                                <input type="text" name="type" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="النوع" value="{{$freelancer->type}}">
                            </div>
<div class="col-md-4 mb-25">
<input type="text" name="certificate" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="الشهادة العلمية" value="{{$freelancer->certificate}}">

                            </div>
                            <div class="col-md-4 mb-25">
                                <div class="form-group select-px-15 text-end">

                                    <select class="form-control px-15 text-end" id="countryOption" name="main_field_id" required>
<option class="text-end" selected disabled>مجال العمل الأساسي</option>
                                        @foreach ($mainfields as $field )

                                    <option value="{{$field->id}}" {{$freelancer->main_field->title == $field->title ? 'selected' : ''}}>{{$field->title}}</option>


                                        @endforeach
                                   </select>

                                </div>
                            </div>

                            <div class="col-md-4 mb-25">
                                <div class="form-group select-px-15 text-end">

                                    <select class="form-control px-15 text-end" id="countryOption0909" name="sub_field_id" required>
<option class="text-end" selected disabled>مجال العمل الفرعي</option>
                                        @foreach ($subfields as $field )

                                    <option value="{{$field->id}}" {{$freelancer->sub_field->title == $field->title ? 'selected' : ''}}>{{$field->title}}</option>


                                        @endforeach
                                   </select>

                                </div>
                            </div>

                            <div class="col-md-6 mb-25">
                                <input type="text" name="products" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="المنتجات او الخدمات" value="{{$freelancer->products}}">
                            </div>
                            <div class="col-md-6 mb-25">
                                <input type="text" name="languages" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="اللغات" value="{{$freelancer->languages}}">
                            </div>
                            <div class="col-md-6 mb-25">
                                <input type="text" name="wphone" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="رقم الواتساب أو الفيسبوك" value="{{$freelancer->wphone}}">
                            </div>
                            <div class="col-md-6 mb-25">
                                <input type="text" name="vphone" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="رقم فودافون كاش" value="{{$freelancer->vphone}}">
                            </div>
                            <div class="col-md-6 mb-25">
                                <input type="text" name="email" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="البريد الإلكتروني" value="{{$freelancer->email}}">
                            </div>
                            <div class="col-md-6 mb-25">
                                <input type="text" name="cv" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="نماذج الأعمال" value="{{$freelancer->cv}}">
                            </div>
                            <div class="col-md-6">
                                <div class="layout-button mt-0">
                                    <button type="submit" class="btn btn-primary btn-default btn-squared px-30">تعديل</button>
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
