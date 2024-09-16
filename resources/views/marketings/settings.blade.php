@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.settings') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>التسويق بالعمولة</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.settings') }}</li>
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
                    <h6>{{ trans('menu.settings') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    {{-- {{ route('store_transfer', app()->getLocale()) }} --}}
                    <form action="{{route('store_settings' , app()->getLocale())}}" method="POST">
                        @csrf
                        <div class="row">


                            <div class="col-md-12 mb-25">

                                {{-- <div class="dm-select"> --}}

                                    <select name="status" id="select-option100" class="form-control ">
                                        @if(isset($Marketing))
                                            <option value="enable" {{$Marketing->status == 'enable' ?'selected' : ''}}>تفعيل</option>
                                            <option value="disable"{{$Marketing->status == 'disable' ?'selected' : ''}}>تعطيل</option>
                                        @else
                                            <option value="enable">تفعيل</option>
                                            <option value="disable">تعطيل</option>
                                        @endif
                                    </select>

                                {{-- </div> --}}

                            </div>

                            <div class="col-md-12 mb-25">
                                <label for="" class="mb-2">الاعدادات المالية لنظام التسويق بالعمولة:</label>
                                @if(isset($Marketing))
                                    <input type="text" name="level1" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="" value="{{$Marketing->level1}}">
                                @else
                                <input type="text" name="level1" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="" value="يُخصم لصالح المسوِّق من (ميزانية التسويق) نسبة (10%) من أرباح مبيعات الطلبات">
                                @endif
                            </div>



                            <div class="col-md-6">
                                <div class="layout-button mt-0">
                                    @if(isset($Marketing))
                                        <button type="submit" class="btn btn-primary btn-default btn-squared px-30">تعديل</button>
                                    @else
                                        <button type="submit" class="btn btn-primary btn-default btn-squared px-30">حفظ</button>
                                    @endif
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
