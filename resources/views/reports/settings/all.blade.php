@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
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
                    <h6>{{ trans('menu.inventory_settings') }}
                    {{-- <a class="btn btn-primary" href="">اضافة مجال عمل</a>  --}}
                </h6>

                <a href="{{ route('add_setting',app()->getLocale()) }}" class="btn btn-primary" >
                    {{trans('menu.add_settings')}}
                </a>
                </div>
                <div class="card-body py-md-30">

                    <div class="userDatatable adv-table-table global-shadow border-0 bg-white w-100 adv-table">
                        <div class="table-responsive">
                            <div class="adv-table-table__header">
                                {{-- <h4>{{ trans('menu.freelancers') }} </h4> --}}

                                  <div class="adv-table-table__button">
                                    {{-- <div class="dropdown">
                                        <a class="btn btn-primary dropdown-toggle dm-select" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Export
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#">copy</a>
                                            <a class="dropdown-item" href="#">csv</a>
                                            <a class="dropdown-item" href="#">print</a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div id="filter-form-container"></div>
{{--                            <table class="table mb-0 table-borderless adv-table" data-sorting="true" data-filter-container="#filter-form-container" data-paging-current="1" data-paging-position="right" data-paging-size="10">--}}
{{--                                <thead>--}}
{{--                                    <tr class="userDatatable-header">--}}
{{--                                        <th>--}}
{{--                                            <span class="userDatatable-title">id</span>--}}
{{--                                        </th>--}}
{{--                                        <th>--}}
{{--                                            <span class="userDatatable-title">الميزانية</span>--}}
{{--                                        </th>--}}
{{--                                        <th>--}}
{{--                                            <span class="userDatatable-title">قيمة ميزانية </span>--}}
{{--                                        </th>--}}



{{--                                        --}}{{-- <th data-type="html" data-name='status'>--}}
{{--                                            <span class="userDatatable-title"></span>--}}
{{--                                        </th> --}}
{{--                                        <th>--}}
{{--                                            <span class="userDatatable-title float-start">العمليات</span>--}}
{{--                                        </th>--}}
{{--                                    </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}

                                    {{-- @foreach ($settings as $setting ) --}}

                                    @if (isset($setting))
                                @foreach($setting as $set)

{{--                                    <tr>--}}

{{--                                        <td>--}}
{{--                                            <div class="userDatatable-content">{{$set->id}}</div>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <div class="d-flex">--}}
{{--                                                <div class="userDatatable-inline-title">--}}
{{--                                                    <a href="#" class="text-dark fw-500">--}}
{{--                                                        <h6>{{$set->title}}</h6>--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <div class="d-flex">--}}
{{--                                                <div class="userDatatable-inline-title">--}}
{{--                                                    <a href="#" class="text-dark fw-500">--}}
{{--                                                        <h6>{{$set->cost}}</h6>--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}

{{--                                            <td>--}}
{{--                                            <ul class="orderDatatable_actions mb-0 d-flex ">--}}

{{--                                                <li>--}}
{{--                                                    <a href="{{route('edit_setting', [app()->getLocale(), $set->id])}}" class="edit">--}}
{{--                                                        <i class="uil uil-edit"></i></a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a href="{{route('delete_setting', [app()->getLocale(), $set->id])}}" class="remove">--}}
{{--                                                        <img src="{{ asset('assets/img/svg/trash-2.svg') }}" alt="trash-2" class="svg"></a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
                            <form action="{{route('update_setting',[app()->getLocale() , $set->id])}}" method="POST">
                                @csrf
                                <div id="setting-container">

                                    <div class="row setting-row">
                                        <div class="col-md-6 mb-25">
                                            <input id="title" type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" value="{{$set->title}}" name="title" required>
                                        </div>
                                        <div class="col-md-6 mb-25">
                                            <input id="cost" type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" value="{{$set->cost}}" name="cost" required>
                                        </div>

                                    </div>
                                </div>
                                <br>

                                <div class="col-md-6 mb-2">
                                    <div class="layout-button mt-0">
                                        <a href="{{route('delete_setting', [app()->getLocale(), $set->id])}}" class="btn btn-danger btn-default btn-squared px-30">حذف</a>

                                        <button type="submit" class="btn btn-primary btn-default btn-squared px-30">تعديل</button>
                                    </div>
                                </div>

                            </form>
                                @endforeach

                                    @endif




                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.add-field')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('store_fields',app()->getLocale())}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-25">
                        <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="مجال العمل" name="title" required>
                    </div>
                    <div class="col-md-6 mb-25">
                        {{-- <input type="" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="النوع"> --}}
                        <div class="form-group select-px-15 text-end">

                            <select class="form-control px-15 text-end" id="countryOption" name="type" required>
                                <option class="text-end">النوع</option>
                                <option value="رئيسي">رئيسي</option>
                                <option value="فرعي">فرعي</option>
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
@endsection
