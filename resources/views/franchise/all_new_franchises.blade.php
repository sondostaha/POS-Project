<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

<!-- Add SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<style>
    .wrapper{
  padding: 40px;
  text-align:center;
}
.wrapper h2{
  padding-bottom: 20px;
}
.wrapper #file-input{
  display:none;
}

.wrapper label[for='file-input'] *{
  vertical-align:middle;
  cursor:pointer;
}

.wrapper label[for='file-input'] span{
  margin-left: 10px
}

.wrapper i.remove{
  vertical-align:middle;
  margin-left: 5px;
  cursor:pointer;
  display:none;
}
</style>
@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card mt-30">
                <div class="card-body">
                    <div class="userDatatable adv-table-table global-shadow border-0 bg-white w-100 adv-table">
                        <div class="table-responsive">
                            <div class="adv-table-table__header">
                                <h4>{{ trans('menu.all_new_franchise') }}</h4>
                                <div class="adv-table-table__button">
                                    <a href="{{route('add_new_franchise' , app()->getLocale())}}"  class="btn btn-primary fs-6 fw-bold text-center" >
                                {{trans('menu.add_new_franchise')}}
                                    </a>
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
                                            <span class="userDatatable-title">اسم الفرانشيز</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">تاريخ الانشاء </span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">قائمة مستقلين المركز العربي</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">المسؤول</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">اسم المسؤول بالكامل</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">البريد الإلكتروني</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">كلمة السر </span>
                                        </th>

                                        <th>
                                            <span class="userDatatable-title">العمليات</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($franchises as $franchise )


                                    <tr>
                                        <td>
                                            <div class="userDatatable-content">{{$franchise->id}}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="userDatatable-inline-title">
                                                        <h6>{{$franchise->name}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">
                                                {{$franchise->created_at->format('Y-m-d')}}

                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">

                                                <div class="userDatatable-inline-title">
                                                    @if ($franchise->access == "true")
                                                    <h6>لدية صلاحية الوصول</h6>
                                                    @else
                                                    <h6>ليس لدية صلاحية الوصول</h6>
                                                    @endif

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">
                                                {{$franchise->username}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">
                                                {{$franchise->allname}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">
                                                {{$franchise->email}}
                                            </div>
                                        </td>



<td>
    <div class="userDatatable-content">
        @php
        try {
            $decryptedPassword = Crypt::decryptString($franchise->password);
            echo $decryptedPassword;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // البيانات إما غير مشفرة أو تالفة
            echo $franchise->password;
        }
        @endphp
    </div>
</td>




                                            <td>
                                            <ul class="orderDatatable_actions mb-0 d-flex ">
                                                <li>
                                                    <a href="{{route('edit_new_franchise' , [app()->getLocale() , $franchise->id])}}" class="edit">
                                                        <i class="uil uil-edit"></i></a>
                                                </li>


<li>
    <a href="javascript:void(0);" class="remove" onclick="confirmDelete('{{route('delete_new_franchise' , [app()->getLocale() , $franchise->id])}}')">
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

<script>
$("document").ready(function () {
  var $file = $("#file-input"),
    $label = $file.next("label"),
    $labelText = $label.find("span"),
    $labelRemove = $("i.remove"),
    labelDefault = $labelText.text();

  // on file change
  $file.on("change", function (event) {
    var fileName = $file.val().split("\\").pop();
    if (fileName) {
      console.log($file);
      $labelText.text(fileName);
      $labelRemove.show();
    } else {
      $labelText.text(labelDefault);
      $labelRemove.hide();
    }
  });

  // Remove file
  $labelRemove.on("click", function (event) {
    $file.val("");
    $labelText.text(labelDefault);
    $labelRemove.hide();
    console.log($file);
  });
});

</script>


<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'ةل انت متأكد؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم ، احذفة',
        cancelButtonText: 'لا',

    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
}
</script>
@endsection
