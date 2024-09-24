@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.Budgets') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>اعدادات الجرد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.Budgets') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12" >
            <div class="card card-Vertical card-default card-md mb-4">
                <div class="card-header">
                    <h6>{{ trans('menu.Budgets') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')

            <form action="{{route('store_setting',app()->getLocale())}}" method="POST">
                @csrf
                <div id="setting-container">

                    <div class="row setting-row">
                    <div class="col-md-4 mb-25">
                        <input id="title" type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="قيمة ميزانية التسويق" name="title[]" required>
                    </div>
                    <div class="col-md-4 mb-25">
                        <input id="cost" type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"  placeholder="10% برجاء ادخال النسبه" name="cost[]" required>
                    </div>
                    <div class="col-md-4 mb-25">
                        <input id="salary" type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="برجاء ادخال المرتب" name="salary[]" required>
                    </div>

                </div>
                </div>
                <br>
                <div class="text-center" style="margin-top: -30px;">
                    <button type="button" class="btn btn-primary" id="add-setting-btn">+</button>
                </div>

                <script>
                    // $(document).ready(function() {
                    //
                    // }
                    const addSettingButton = document.getElementById('add-setting-btn');
                    const inputContainer = document.getElementById('setting-container');
                    // console.log(inputContainer);
                    addSettingButton.addEventListener('click', () => {
                        // console.log(inputContainer)
                        const newRow = document.createElement('div');
                        // console.log(newRow)
                        newRow.className =  'row setting-row';

                        newRow.innerHTML = `
        <div class="col-md-4 mb-25">
            <input id="title" type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="قيمة ميزانية التسويق" name="title[]" >
        </div>
        <div class="col-md-4 mb-25">
            <input id="cost" type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="10% برجاء ادخال النسبه" name="cost[]" >
        </div>
        <div class="col-md-4 mb-25">
             <input id="salary" type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="برجاء ادخال المرتب" name="salary[]" >
         </div>
        `;
                        inputContainer.appendChild(newRow);
                    });
                </script>

                <div class="col-md-6 mb-2">
                    <div class="layout-button mt-0">
                        <button type="submit" class="btn btn-primary btn-default btn-squared px-30">حفظ</button>
                    </div>
                </div>

            </form>
            <p class="text-danger fw-600">القيمة التي تضاف هنا نسبة من صافي الأرباح بعد خصم مصاريف التشغيل</p>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
