@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.operating_expenses') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>{{ trans('menu.operating_expenses') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.all_operating_expenses') }}</li>
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
                    <h6>{{ trans('menu.operating_expenses') }}
                    {{-- <a class="btn btn-primary" href="">اضافة مجال عمل</a>  --}}
                </h6>

                <a href="{{route('add_operating' , app()->getLocale())}}" class="btn btn-primary" >
                    {{trans('menu.add_operating_expenses')}}
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
                            <table class="table mb-0 table-borderless adv-table" data-sorting="true" data-filter-container="#filter-form-container" data-paging-current="1" data-paging-position="right" data-paging-size="10">
                                <thead>
                                    <tr class="userDatatable-header">

                                        <th>
                                            <span class="userDatatable-title">العنوان</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">القيمة</span>
                                        </th>


                                        {{-- <th data-type="html" data-name='status'>
                                            <span class="userDatatable-title"></span>
                                        </th> --}}
                                        <th>
                                            <span class="userDatatable-title float-start">العمليات</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($operatings as $operating )

                                    @foreach (json_decode($operating->details) as $detail)


                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="userDatatable-inline-title">
                                                    <a href="#" class="text-dark fw-500">
                                                        <h6>{{$detail->title}}</h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="userDatatable-inline-title">
                                                    <a href="#" class="text-dark fw-500">
                                                        <h6>{{$detail->value}}</h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                            <td>
                                            <ul class="orderDatatable_actions mb-0 d-flex ">

                                                <li>
                                                    <a href="{{route('edit_operating', [app()->getLocale(), $operating->id])}}" class="edit">
                                                        <i class="uil uil-edit"></i></a>
                                                </li>
                                                <li>
                                                    <a href="{{route('delete_operating', [app()->getLocale(), $operating->id])}}" class="remove">
                                                        <img src="{{ asset('assets/img/svg/trash-2.svg') }}" alt="trash-2" class="svg"></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    @endforeach
                                    @endforeach



                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection
