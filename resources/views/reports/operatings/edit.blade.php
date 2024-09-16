@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.edit_operating_expenses') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>مصاريف التشغيل</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.operating_expenses') }}</li>
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
                    <h6>{{ trans('menu.edit_operating_expenses') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')

            <form action="{{route('update_operating', [app()->getLocale() , $operating->id])}}" method="POST">
                @csrf
                <div class="row" id="operatingRows">
                    @foreach (json_decode($operating->details) as $detail)
                    <div class="col-md-6 mb-25">
                        <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="العنوان" name="title[]" value="{{ $detail->title }}" required>
                    </div>
                    <div class="col-md-6 mb-25">
                        <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="القيمة" name="value[]" value="{{ $detail->value }}" required>
                    </div>
                @endforeach
                </div>
                
                <button type="button" class="btn btn-primary btn-sm" onclick="addRow()">+ إضافة عنوان وقيمة جديدة</button>
                
                <script>
                    function addRow() {
                        var newRow = `
                            <div class="col-md-6 mb-25">
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="العنوان" name="title[]" required>
                            </div>
                            <div class="col-md-6 mb-25">
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="القيمة" name="value[]" required>
                            </div>
                        `;
                        document.getElementById('operatingRows').insertAdjacentHTML('beforeend', newRow);
                    }
                </script>

            </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
