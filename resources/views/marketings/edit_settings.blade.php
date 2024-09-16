@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.edit_settings') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>التسويق بالعمولة</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.edit_settings') }}</li>
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
                    <h6>{{ trans('menu.edit_settings') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    {{-- {{ route('store_transfer', app()->getLocale()) }} --}}
                    <form action="{{route('update_settings' , app()->getLocale())}}" method="POST">
                        @csrf
                        <div class="row">


                            <div class="col-md-12 mb-25">

                                {{-- <div class="dm-select"> --}}

                                    <select name="status" id="select-option100" class="form-control ">
                                        <option value="enable" {{ isset($setting->status) && $setting->status == "enable" ? 'selected' : '' }}>تفعيل</option>
                                        <option value="disable" {{ isset($setting->status) && $setting->status == "disable" ? 'selected' : '' }}>تعطيل</option>
                                    </select>

                                {{-- </div> --}}

                            </div>

                            <div class="col-md-12 mb-25">
                                <label for="" class="mb-2">الاعدادات المالية لنظام التسويق بالعمولة للمستوي الأول:</label>
                                <input type="text" name="level1" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="" value="{{isset($setting->level1) ? $setting->level1 : '' }}">
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

<script>

</script>
