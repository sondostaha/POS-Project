@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.edit_new_franchise') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>الفرانشيز</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.edit_new_franchise') }}</li>
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
                    <h6>{{ trans('menu.edit_new_franchise') }}</h6>
                </div>
                <div class="card-body py-md-30">
                
                    @include('partials._errors')

                      <form action="{{route('update_new_franchise' , [app()->getLocale() , $franchise->id])}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-25">
                                <input type="text" name="name" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="اسم الفرانشيز" value="{{$franchise->name}}">
                            </div>
                            <div class="col-md-6">
                                <div class="checkbox-theme-default custom-checkbox mb-4 ">
<input class="checkbox" value="true" type="checkbox" name="access" id="araby" {{ $franchise->access === 'true' ? 'checked' : '' }}>
                                    
                                    <label for="araby">
                                        <span class="checkbox-text">
                                           الوصول إلي قائمة مستقلين المركز العربي
                                        </span>
                                    </label>
                                </div>

                            </div>


                            <p>مسؤول الفرانشيز:</p>

                            <div class="col-md-6 mb-25">
                                <input type="text" name="username" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="اسم المسؤول" value="{{$franchise->username}}">
                            </div>

                            <div class="col-md-6 mb-25">
                                <input type="text" name="allname" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="الأسم الكامل" value="{{$franchise->allname}}">
                            </div>
                            <div class="col-md-6 mb-25">
                                <input type="email" name="email" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="البريد الإلكتروني" value="{{$franchise->email}}">
                            </div>
                            <div class="col-md-6 mb-25">
                                <input type="password" name="password" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="كلمة السر" value="">
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