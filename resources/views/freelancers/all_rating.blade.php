@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.all_ratings') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>{{ trans('menu.ratings') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.all_ratings') }}</li>
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
                    <h6>{{ trans('menu.all_ratings') }}
                    {{-- <a class="btn btn-primary" href="">اضافة مجال عمل</a>  --}}
                </h6>

                <a href="{{route('add_rating' , app()->getLocale())}}" class="btn btn-primary" >
                    {{trans('menu.add_rating')}}
                </a>  
                </div>
                <div class="card-body py-md-30">

                    <div class="userDatatable adv-table-table global-shadow border-0 bg-white w-100 adv-table">
                        <div class="table-responsive">
                            <div class="adv-table-table__header">
                                                              
                            </div>
                            <div id="filter-form-container"></div>
                            <table class="table mb-0 table-borderless adv-table" data-sorting="true" data-filter-container="#filter-form-container" data-paging-current="1" data-paging-position="right" data-paging-size="10">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th>
                                            <span class="userDatatable-title">id</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">الأسم</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">التقييم</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">التعليق</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title float-start">العمليات</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                    @foreach ($ratings as $rating )
                                        
                                    
                                    <tr>
                                        <td>
                                            <div class="userDatatable-content">{{$rating->id}}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="userDatatable-inline-title">
                                                    <a href="#" class="text-dark fw-500">
                                                        <h6>{{$rating->freelancer->name}}</h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="userDatatable-inline-title">
                                                    <a href="#" class="text-dark fw-500">
                                                        <h6>{{$rating->rating}}/10</h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex">
                                                <div class="userDatatable-inline-title">
                                                    <a href="#" class="text-dark fw-500">
                                                        <h6>{{$rating->comment}}</h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                            <td>
                                            <ul class="orderDatatable_actions mb-0 d-flex ">

                                                <li>
                                                    <a href="{{route('edit_rating', [app()->getLocale(), $rating->id])}}" class="edit">
                                                        <i class="uil uil-edit"></i></a>
                                                </li>
                                                <li>
                                                    <a href="{{route('delete_rating', [app()->getLocale(), $rating->id])}}" class="remove">
                                                        <img src="{{ asset('assets/img/svg/trash-2.svg') }}" alt="trash-2" class="svg"></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

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