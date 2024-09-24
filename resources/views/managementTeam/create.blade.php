@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">

        <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.add_management_team') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>فريق الاداره </a></li>
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
                    <form action="{{route('managementTeam.store', app()->getLocale())}}" method="POST">
                        @csrf
                        <div class="row">
                            @if(isset($ManagementTeams))

                            <div class="col-md-6 mb-25">
                                <p style="color:#000;font-weight: bolder;">نسبه مدير المبيعات  :</p>

                                    <input type="text" name="sales_manager" class="form-control ih-medium ip-gray radius-xs b-light px-15"   value="{{$ManagementTeams->sales_manager}}">

                            </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب مدير المبيعات  :</p>

                                    <input type="text" name="sales_manager_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15"   value="{{$ManagementTeams->sales_manager_salary}}">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه مدير التسويق  :</p>

                                    <input type="text" name="marketing_manager" class="form-control ih-medium ip-gray radius-xs b-light px-15"   value="{{$ManagementTeams->marketing_manager}}">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب مدير التسويق  :</p>

                                    <input type="text" name="marketing_manager_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15"   value="{{$ManagementTeams->marketing_manager_salary}}">

                                </div>

                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه المدير التقني :</p>

                                    <input type="text" name="technical_director" class="form-control ih-medium ip-gray radius-xs b-light px-15"     value="{{$ManagementTeams->technical_director}}">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب المدير التقني :</p>

                                    <input type="text" name="technical_director_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15"     value="{{$ManagementTeams->technical_director_salary}}">

                                </div>

                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه المدير المالي :</p>

                                    <input type="text" name="CFO" class="form-control ih-medium ip-gray radius-xs b-light px-15"    value="{{$ManagementTeams->CFO}}">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب المدير المالي :</p>

                                    <input type="text" name="CFO_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15"    value="{{$ManagementTeams->CFO_salary}}">

                                </div>

                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مسبه المدير التنفيذي :</p>

                                    <input type="text" name="CEO" class="form-control ih-medium ip-gray radius-xs b-light px-15"     value="{{$ManagementTeams->CEO}}">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب المدير التنفيذي :</p>

                                    <input type="text" name="CEO_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15"     value="{{$ManagementTeams->CEO_salary}}">

                                </div>

                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه مدير الموارد البشريه :</p>

                                    <input type="text" name="hr_manager" class="form-control ih-medium ip-gray radius-xs b-light px-15"      value=" {{$ManagementTeams->hr_manager}}">
                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب مدير الموارد البشريه :</p>

                                    <input type="text" name="hr_manager_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15"      value=" {{$ManagementTeams->hr_manager_salary}}">
                                </div>
                            @else
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه مدير المبيعات  :</p>

                                    <input type="text" name="sales_manager" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="نسبه مدير المبيعات" value="0">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب مدير المبيعات  :</p>

                                    <input type="text" name="sales_manager_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="مرتب مدير المبيعات" value="0">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه مدير التسويق  :</p>

                                    <input type="text" name="marketing_manager" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="نسبه مدير التسويق" value="0">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب مدير التسويق  :</p>

                                    <input type="text" name="marketing_manager_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="مرتب مدير التسويق" value="0">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه المدير التقني :</p>

                                    <input type="text" name="technical_director" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="نسبه المدير التقني" value="0">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب المدير التقني :</p>

                                    <input type="text" name="technical_director_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="مرتب المدير التقني" value="0">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه المدير المالي :</p>

                                    <input type="text" name="CFO" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="نسبه المدير المالي" value="0">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب المدير المالي :</p>

                                    <input type="text" name="CFO_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="مرتب المدير المالي" value="0">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه المدير التنفيذي :</p>

                                    <input type="text" name="CEO" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="نسبه المدير التنقيذي" value="0">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب المدير التنفيذي :</p>

                                    <input type="text" name="CEO_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="مرتب المدير التنقيذي" value="0">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">نسبه مدير الموارد البشريه :</p>

                                    <input type="text" name="hr_manager" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="نسبه مدير الموارد البشريه" value="0">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <p style="color:#000;font-weight: bolder;">مرتب مدير الموارد البشريه :</p>

                                    <input type="text" name="hr_manager_salary" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="مرتب مدير الموارد البشريه" value="0">

                                </div>
                            @endif


                            <div class="col-md-12 mb-25">
                                <div class="layout-button mt-0">
                                    @if($ManagementTeams)
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
