@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.add-freelancer') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.request-freelancer') }}</li>
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
                    <h6>{{ trans('menu.request-freelancer') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    <form action="{{route('store_request_freelancer' , app()->getLocale())}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-25">
                                <div class="form-group select-px-15 text-end">
                    
                                    <select class="form-control px-15 text-end" id="mainField" name="main_field_id" required>
                                        <option class="text-end" selected disabled>مجال العمل الرئيسي</option>
                                        @foreach($mainfields as $field)
                                        <option value="{{$field->id}}">
                                            {{$field->title}}
                                            </option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-25">
                                <div class="form-group select-px-15 text-end">
            
                                    <select class="form-control px-15 text-end" id="countryOption0909" name="sub_field_id" required>
                                            <option class="text-end" selected disabled>مجال العمل الفرعي</option>
                                        @foreach ($subfields as $field )

                                        <option value="{{$field->id}}">{{$field->title}}</option>

                                        @endforeach
                                   </select>

                                </div>
                            </div>

                            <div class="col-md-6 mb-25">
                            <input type="text" name="desc" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="الوصف" value="{{old('desc')}}">
                            </div>

                            <div class="col-md-6 mb-25">
                                <div class="checkbox-theme-default custom-checkbox ">
<input class="checkbox" value="هام و عاجل" type="checkbox" name="status" id="check-un1">
                                    <label for="check-un1">
                                        <span class="checkbox-text">
                                            هام و عاجل
                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox-theme-default custom-checkbox ">
<input class="checkbox" value="هام وغير عاجل" type="checkbox" name="status" id="check-un2">
                                    <label for="check-un2">
                                        <span class="checkbox-text">
                                            هام وغير عاجل
                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox-theme-default custom-checkbox ">
<input class="checkbox" value="غير هام وغير عاجل" type="checkbox" name="status" id="check-un3">
                                    <label for="check-un3">
                                        <span class="checkbox-text">
                                            غير هام و غير عاجل
                                        </span>
                                    </label>
                                </div>
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