@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.edit_permission') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.permissions') }}</li>
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
                    <h6>{{ trans('menu.edit_permission') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    <form action="{{route('update_permissions' ,[app()->getLocale() , $permission->id])}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-25">
                                <input type="text" name="name" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="الصلاحية" value="{{$permission->name}}">
                            </div>

                            <div class="col-md-6 mb-25">
                                <select name="group_name" id="countryOptionP" class="form-control px-15 ">
                                    <option value="">الفئة</option>
                                    <option value="المستقلين" {{$permission->group_name == 'المستقلين' ? 'selected' : ''}}>المستقلين</option>
                                    <option value="العملاء">العملاء</option>
                                    <option value="الطلبات">الطلبات</option>
                                    <option value="المالية">التقرير المالي</option>
                                    <option value="التسويق بالعمولة">التسويق بالعمولة</option>
                                    <option value="المستخدمين">فريق العمل</option>
                                    <option value="الفرانشيز">الفرانشيز</option>
                                    <option value="الإحصائيات">الإحصائيات</option>
                                    <option value="backup">نسخ احتياطية</option>

                                </select>
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