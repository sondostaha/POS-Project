<!-- Add SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.work_fields') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>{{ trans('menu.freelancers') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.work_fields') }}</li>
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
                    <h6>{{ trans('menu.work_fields') }}
                    {{-- <a class="btn btn-primary" href="">اضافة مجال عمل</a>  --}}
                </h6>

                <a href="{{route('add_fields' , app()->getLocale())}}" class="btn btn-primary" >
                    {{trans('menu.add_main_field')}}
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
                                            <span class="userDatatable-title">id</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">الأسم</span>
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
                            
                                    @foreach ($fields as $field )
                                        
                                    
                                    <tr>
                                        <td>
                                            <div class="userDatatable-content">{{$field->id}}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="userDatatable-inline-title">
                                                    <a href="#" class="text-dark fw-500">
                                                        <h6>{{$field->title}}</h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                            <td>
                                            <ul class="orderDatatable_actions mb-0 d-flex ">

                                                <li>
                                                    <a href="{{route('edit_fields', [app()->getLocale(), $field->id])}}" class="edit">
                                                        <i class="uil uil-edit"></i></a>
                                                </li>

<li>
    <a href="javascript:void(0);" class="remove" onclick="confirmDelete('{{route('delete_fields', [app()->getLocale(), $field->id])}}')">
        <img src="{{ asset('assets/img/svg/trash-2.svg') }}" alt="trash-2" class="svg">
    </a>
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


<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'هل انت متأكد؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم ، احذفه',
        cancelButtonText: 'لا',

    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
}
</script>


@endsection

