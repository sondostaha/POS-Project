@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid" style="overflow-x: hidden;">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.all_settings') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>{{ trans('menu.inventory_settings') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.all_settings') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <div class="card card-Vertical card-default card-md mb-4">
                <div class="card-header d-flex align-items-center">
                    <h6>{{ trans('menu.inventory_settings') }}</h6>
                    <a href="{{ route('add_setting',app()->getLocale()) }}" class="btn btn-primary btn-sm ml-auto">
                        {{trans('menu.add_settings')}}
                    </a>
                </div>
                <div class="card-body py-md-30">

<div class="userDatatable adv-table-table global-shadow border-0 bg-white w-100 adv-table" style="overflow-x: hidden;">
    <div>
        <div id="filter-form-container"></div>
        @if (isset($setting))
            @foreach($setting as $set)
                <form action="{{route('update_setting',[app()->getLocale() , $set->id])}}" method="POST">
                    @csrf
                    <div id="setting-container">
                        <div class="row setting-row">
                            <div class="col-md-4 mb-25">
                                <p style="color:#000;font-weight: bolder;">الميزانية</p>
                                <input id="title" type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" value="{{$set->title}}" name="title" placeholder="قيمة ميزانية التسويق" required>
                            </div>
                            <div class="col-md-4 mb-25">
                                <p style="color:#000;font-weight: bolder;">النسبة</p>
                                <input id="cost" type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" value="{{$set->cost}}" name="cost" placeholder="10% برجاء ادخال النسبة" required>
                            </div>
                            <div class="col-md-4 mb-25">
                                <p style="color:#000;font-weight: bolder;">القيمة</p>
                                <input id="salary" type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" value="{{$set->salary}}" name="salary" placeholder="برجاء ادخال المرتب" required>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mt-3 mb-3">
                        <button type="submit" class="btn btn-primary btn-sm px-20 me-2">تعديل</button>
                        <a href="{{route('delete_setting', [app()->getLocale(), $set->id])}}" class="btn btn-danger btn-sm px-20">حذف</a>
                    </div>
                </form>
            @endforeach
        @endif
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
