@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">

        <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.add_sales_team') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>فريق المبيعات </a></li>
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
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    <form action="{{route('SalesTeam.store', app()->getLocale())}}" method="POST">
                        @csrf
                        <div class="row">
                            @if(isset($SalesTeams))

                            <div class="col-md-6 mb-25">
                                <p style="color:#000;font-weight: bolder;">نسبه وكيل المبيعات  :</p>

                                    <input type="text" name="sales_agent" class="form-control ih-medium ip-gray radius-xs b-light px-15"   value="{{$SalesTeams->sales_agent}}">

                            </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب وكيل المبيعات  :</p>

                                    <input type="text" name="sales_agent_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15"   value="{{$SalesTeams->sales_agent_salary}}">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه مسؤول المبيعات :</p>


                                    <input type="text" name="sales_officer" class="form-control ih-medium ip-gray radius-xs b-light px-15"   value="{{$SalesTeams->sales_officer}}">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب مسؤول المبيعات :</p>


                                    <input type="text" name="sales_officer_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15"   value="{{$SalesTeams->sales_officer_salary}}">

                                </div>

                            @else
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه وكيل المبيعات  :</p>

                                    <input type="text" name="sales_agent" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="نسبه وكيل المبيعات" value="">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب وكيل المبيعات  :</p>

                                    <input type="text" name="sales_agent_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="مرتب وكيل المبيعات" value="">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه مسؤول المبيعات :</p>

                                    <input type="text" name="sales_officer" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="نسبه مسؤول المبيعات" value="">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;"> مرتب مسؤول المبيعات :</p>

                                    <input type="text" name="sales_officer_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="مرتب مسؤول المبيعات" value="">

                                </div>

                            @endif


                            <div class="col-md-12 mb-25">
                                <div class="layout-button mt-0">
                                    @if($SalesTeams)
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


<script src="https://cdn.ckeditor.com/4.22.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('text');
</script>





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
