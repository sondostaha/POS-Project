@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.edit_role') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.roles') }}</li>
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
                    <h6>{{ trans('menu.edit_role') }}</h6>
                </div>
                <div class="card-body py-md-30">

<form class="mt-3" action="{{ route('roles.update', ['language' => app()->getLocale(), 'id' => $role->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="mb-2" for="name">اسم الدور</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
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
                        <td><input type="checkbox" name="permissions[]" value="{{ 'اضافة ' . $section }}" {{ $role->hasPermissionTo('اضافة ' . $section) ? 'checked' : '' }} /></td>
                        <td><input type="checkbox" name="permissions[]" value="{{ 'عرض ' . $section }}" {{ $role->hasPermissionTo('عرض ' . $section) ? 'checked' : '' }} /></td>
                        <td><input type="checkbox" name="permissions[]" value="{{ 'تعديل ' . $section }}" {{ $role->hasPermissionTo('تعديل ' . $section) ? 'checked' : '' }} /></td>
                        <td><input type="checkbox" name="permissions[]" value="{{ 'حذف ' . $section }}" {{ $role->hasPermissionTo('حذف ' . $section) ? 'checked' : '' }} /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">تعديل الدور</button>
    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection