@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.add_transfer') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>الحوالات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.add_transfer') }}</li>
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
                    <h6>{{ trans('menu.add_transfer') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    {{-- {{ route('store_transfer', app()->getLocale()) }} --}}
                    <form action="{{route('store_transfer' , app()->getLocale())}}" method="POST">
                        @csrf
                        <div class="row">


                            <div class="col-md-4 mb-25">
                                <input type="text" readonly id="randomNumber" name="number" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="الرقم التعريفي للحوالة" value="">
                            </div>

                            <script>
                                // Generate random number
                                function generateRandomNumber() {
                                    var randomNumber = Math.floor(Math.random() * 1000000); // You can adjust this range as needed
                                    document.getElementById('randomNumber').value = randomNumber;
                                }
                            
                                // Call the function to generate random number on page load
                                generateRandomNumber();
                            </script>

                            <div class="col-md-4 mb-25">
                                <input type="text" name="value" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="قيمة الحوالة الإجمالية" value="">
                            </div>
                            
                            <div class="col-md-4">


                        <div class="dm-select">

                            <select name="method" id="select-alerts333333" class="form-control">
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


                            <div class="col-md-4 mb-25">
                                <input type="text" name="proof" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="إثبات التحويل" value="">
                            </div>

                            <div class="col-md-4 mb-25">

                                <div class="dm-select">

                                    <select name="officer" id="select-alerts33" class="form-control ">
                                        <option value=""></option>
                                        @foreach ($officers as $officer )
                                        <option value="{{$officer->name}}">{{$officer->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-md-4 mb-25">

                                <div class="dm-select">

                                    <select name="agent" id="select-alerts22" class="form-control ">
                                        <option value=""></option>
                                        @foreach ($agents as $agent )
                                        <option value="{{$agent->name}}">{{$agent->name}}</option>
                                        @endforeach
                                    </select>

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

<script>

</script>