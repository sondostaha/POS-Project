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
                            <h4>{{ trans('menu.all_inventories') }}</h4>
                            <div class="adv-table-table__button">
                                <a href="{{route('inventory.report' , app()->getLocale())}}"  class="btn btn-primary fs-6 fw-bold text-center" >
                            {{trans('menu.make_inventory')}}
                                </a>
                            </div>
                        </div>

                            <div class="table-responsive">
                                <table class="table text-md-nowrap mt-2" id="example1">
                                  <thead>
                                    <tr>
                                      <th class="wd-15p border-bottom-0 " >id</th>
                                      <th class="wd-15p border-bottom-0 " >إجمالي الإيرادات</th>
                                      <th class="wd-15p border-bottom-0 " >صافي الربح</th>
                                      <th class="wd-15p border-bottom-0 " >تاريخ الجرد</th>

                                      <th class="wd-10p border-bottom-0 " >العمليات</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ( $inventories as $inventory )
                                    <tr>

                                        <td>{{$inventory->id}}</td>
                                        <td>{{$inventory->totalRevenue}}</td>
                                        <td>{{$inventory->netProfit}}</td>
                                        <td>{{date_format(date_create($inventory->created_at),'Y-m-d')}}</td>

                                    <td>
                                        <ul class="orderDatatable_actions mb-0 d-flex ">
                                            <li>
                                                <a href="{{ route('inventory.show' , [app()->getLocale(), $inventory->id]) }}" title="عرض" class="view">
                                                    <i class="uil uil-eye"></i></a>

                                            </li>


                                            <li>
                                                <a href="javascript:void(0);" class="remove" onclick="confirmDelete('{{route('delete_order' , [app()->getLocale() , $inventory->id])}}')">
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
</div>





<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.add-freelancers')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

            <form class="form-container" action="{{route('saveFreelancers',app()->getLocale())}}" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="wrapper">
                    <h2>{{trans('menu.Custom_File_Input')}}</h2>
                    <input type="file" name="file" id="file-input">
                    <label for="file-input">
                      <i class="fa fa-paperclip fa-2x"></i>
                      <span></span>
                    </label>
                    <i class="fa fa-times-circle remove"></i>
                  </div>
                  <button type="submit" class="btn btn-primary">رفع</button>
            </form>




        </div>

      </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

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
