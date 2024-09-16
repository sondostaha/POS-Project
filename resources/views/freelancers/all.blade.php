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
                            <div class="adv-table-table__header mb-2">
                                <h4>{{ trans('menu.freelancers') }}</h4>

                                {{-- <div class="adv-table-table__button d-flex">
                                  <a style="padding: 10px;
                                  padding-right: 18px;" type="button" class="btn btn-primary upp" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                      <i class="fa-solid fa-upload fa-xl"></i>
                                  </a>

                                    <a style="padding: 10px;
                                    padding-right: 18px;" href="{{route('exportFreelancers',app()->getLocale())}}" class="btn btn-primary upp me-2">
                                          <i class="fa-solid fa-download"></i>
                                  </a>

                                    <a style="padding: 10px;
                                    padding-right: 15px;" href="{{route('add_freelancer',app()->getLocale())}}" class="btn btn-primary upp">
                                          <i class="fa-solid fa-plus"></i>
                                  </a>
                                  <a style="padding: 10px;
                                  padding-right: 15px;" href="{{route('delete_all_freelancers',app()->getLocale())}}" class="btn btn-primary upp">
                                    <img src="{{ asset('assets/img/svg/trash-2.svg') }}" alt="trash-2" class="svg"></a>
                                </div> --}}


                            </div>




    <form action="{{ route('filter_free' , app()->getLocale()) }}" method="POST">
      @csrf

          <div class="row" style="margin-left: 0 !important;">
            <div class="col-md-4">

            <div class="form-group select-px-15 text-end">
              <select class="form-control px-15 text-end" id="filterFree" name="filterB" required>
                  <option class="text-end" value=""></option>
                  <option class="text-end" value="all">الكل</option>
                  <option class="text-end" value="hot">القائمة الساخنة</option>
                  <option class="text-end" value="cold">القائمة الباردة</option>
                  <option class="text-end" value="archive">الأرشيف</option>
             </select>


          </div>

        </div>

        <div class="col-md-2">
          <button class="btn btn-primary" type="submit">فرز</button>

        </div>

    </form>

                            <div class="col-md-6" >

                                <div class="adv-table-table__header" style="float: left">
                                    <div class="adv-table-table__button d-flex">
                                        <a style="padding: 10px;
          padding-right: 18px;" type="button" class="btn btn-primary upp" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fa-solid fa-upload fa-xl"></i>
                                        </a>

{{--                                        <a style="padding: 10px;--}}
{{--            padding-right: 18px;" href="{{route('exportFreelancers',app()->getLocale())}}" class="btn btn-primary upp me-2">--}}
{{--                                            <i class="fa-solid fa-download"></i>--}}
{{--                                        </a>--}}

                                        <a style="padding: 10px;
            padding-right: 15px;" href="{{route('add_freelancer',app()->getLocale())}}" class="btn btn-primary upp">
                                            <i class="fa-solid fa-plus"></i>
                                        </a>


                                        <a href="javascript:void(0);" style="padding: 10px;
          padding-right: 15px;" class="remove btn btn-primary upp" onclick="confirmDelete('{{route('delete_all_freelancers',app()->getLocale())}}')">
                                            <img src="{{ asset('assets/img/svg/trash-2.svg') }}" alt="trash-2" class="svg">
                                        </a>
                                    </div>


                                </div>
  </div>






</div>

                            {{-- <div id="filter-form-container"></div> --}}

                            <div class="table-responsive">

                                <table class="table text-md-nowrap mt-2" id="example1">

                                    <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0 " >id</th>
                                        <th class="wd-15p border-bottom-0 " >الأسم</th>
                                        {{-- <th class="wd-15p border-bottom-0 " >البريد الإلكتروني</th> --}}
                                        <th class="wd-10p border-bottom-0 " >مجال العمل الرائسي</th>
                                        <th class="wd-15p border-bottom-0 " >مجال العمل الفرعي</th>
                                        <th class="wd-15p border-bottom-0 " >المنتجات التي يقدمها</th>
                                        <th class="wd-15p border-bottom-0 " >اللغه</th>

                                        {{-- <th class="wd-10p border-bottom-0 " >الكورس</th>
                                        <th class="wd-10p border-bottom-0 " >اللغة</th> --}}
                                        {{-- <th class="wd-10p border-bottom-0 " >الشهادة العلمية ومجال العمل الأساسي</th> --}}
                                        {{-- <th class="wd-10p border-bottom-0 " >مجالات العمل الرئيسية عن بعد</th> --}}
                                        {{-- <th class="wd-10p border-bottom-0 " >المنتجات التي يمكنك تقديمها</th> --}}
                                        {{-- <th class="wd-10p border-bottom-0 " >اللغات</th> --}}
                                        {{-- <th class="wd-10p border-bottom-0 " >رقم الواتساب او الفيس بوك</th> --}}
                                        {{-- <th class="wd-10p border-bottom-0 " >رقم فودافون كاش</th> --}}
                                        {{-- <th class="wd-10p border-bottom-0 " >نماذج الأعمال</th> --}}
{{--                                        <th class="wd-10p border-bottom-0 " >التقييم</th>--}}
                                        <th class="wd-10p border-bottom-0 " >الأجازات</th>
                                        <th class="wd-10p border-bottom-0 " >العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ( $freelancers as $freelancer )
                                        <tr>
                                            <td >{{$freelancer->id}}</td>
                                            <td >{{$freelancer->name}}</td>
                                            <td >{{$freelancer->main_field->title}}</td>
                                            <td >{{$freelancer->sub_field->title}}</td>
                                            <td >{{$freelancer->products}}</td>
                                            <td >{{$freelancer->languages}}</td>

                                            {{-- <td >{{$freelancer->certificate}}</td> --}}
                                            {{-- <td >{{$freelancer->field_type}}</td> --}}
                                            {{-- <td >{{$freelancer->products}}</td> --}}
                                            {{-- <td >{{$freelancer->languages}}</td> --}}
                                            {{-- <td >{{$freelancer->wphone}}</td> --}}
                                            {{-- <td >{{$freelancer->vphone}}</td> --}}
                                            {{-- <td >{{$freelancer->cv}}</td> --}}

                                            {{--                                      @php--}}
                                            {{--                                        $rate = DB::table('ratings')->select('rating')->where('freelancer_id' , $freelancer->id)->value('rating');--}}
                                            {{--                                      @endphp--}}

                                            {{--                                      <td>--}}
                                            {{--                                        @if ($rate)--}}

                                            {{--                                        {{ $rate }}--}}

                                            {{--                                        @else--}}

                                            {{--                                        0--}}

                                            {{--                                        @endif--}}
                                            {{--                                      </td>--}}


                                            <td>
                                                @if (App\Models\Holiday::where('freelancer_id' , $freelancer->id )->exists())

                                                    <span class="bg-opacity-danger  color-danger rounded-pill userDatatable-content-status active">اجازة</span>
                                                @else
                                                    <span>لا يوجد</span>
                                                @endif

                                            </td>





                                            <td>
                                                <ul class="orderDatatable_actions mb-0 d-flex ">
                                                    <li>
                                                        <a href="{{ route('show_freelancer' , [app()->getLocale(), $freelancer->id]) }}" title="عرض" class="view">
                                                            <i class="uil uil-eye"></i></a>

                                                    </li>
                                                    <li>
                                                        <a href="{{ route('holiday' , [app()->getLocale(), $freelancer->id]) }}" title="اجازة" class="view">
                                                            <i class="fa-solid fa-house"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('return_holiday' , [app()->getLocale(), $freelancer->id]) }}" title="عودة من الأجازة" class="view">
                                                            <i class="fa-solid fa-rotate-left"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('edit_freelancer', [app()->getLocale(), $freelancer->id])}}" title="تعديل" class="edit">
                                                            <i class="uil uil-edit"></i></a>
                                                    </li>


                                                    <li>
                                                        <a href="javascript:void(0);" class="remove" onclick="confirmDelete('{{route('delete_freelancer', [ app()->getLocale() , $freelancer->id])}}')">
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
