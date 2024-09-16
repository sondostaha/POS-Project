<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

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
                                <h4>{{ trans('menu.add_role') }}</h4>
                                {{-- <div class="adv-table-table__button">
                                    <a href="{{route('add_role' , app()->getLocale())}}"  class="btn btn-primary fs-6 fw-bold text-center" >
                                {{trans('menu.add_role')}}
                                    </a>   
                                </div> --}}
                            </div>
                            <div id="filter-form-container"></div>
                <form class="mt-3" action="{{ route('roles.store' , app()->getLocale()) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="mb-2" for="name">اسم الدور</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>الصلاحيات</th>
                                <th>إضافة</th>
                                <th>عرض</th>
                                <th>تعديل</th>
                                <th>مسح</th>
                            </tr>
                        </thead>
                        <tbody>
                @foreach(['المستخدمين' , 'الصلاحيات' , 'العملاء' , 'الفرانشيز' , 'مجالات العمل' , 'المستقلين' , 'الطلبات' , 'التسوق بالعمولة' , 'التقرير المالي' , 'مصاريف التشغيل' , 'اعدادات الجرد'] as $section)

                                <tr>
                                    <td>{{ $section }}</td>
                                    <td><input type="checkbox" name="permissions[]" value="{{ 'اضافة ' . $section }}" /></td>
                                    <td><input type="checkbox" name="permissions[]" value="{{ 'عرض ' . $section }}" /></td>
                                    <td><input type="checkbox" name="permissions[]" value="{{ 'تعديل ' . $section }}" /></td>
                                    <td><input type="checkbox" name="permissions[]" value="{{ 'حذف ' . $section }}" /></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">اضافة الدور</button>
                </form>
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
@endsection
