<style>

.main {
    margin-top: 2%;
    margin-left: 29%;
    font-size: 28px;
    padding: 0 10px;
    width: 100%;
}

.main h2 {
    color: #333;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 24px;
    margin-bottom: 10px;
}

.main .card {
    background-color: #fff;
    border-radius: 18px;
    box-shadow: 1px 1px 8px 0 grey;
    height: auto;
    margin-bottom: 20px;
    padding: 20px 0 20px 50px;
}

.main .card table {
    border: none;
    font-size: 16px;
    height: 270px;
    width: 80%;
}

.edit {
    position: absolute;
    color: #e7e7e8;
    right: 14%;
}

.social-media {
    text-align: center;
    width: 90%;
}

.social-media span {
    margin: 0 10px;
}

.fa-facebook:hover {
    color: #4267b3 !important;
}

.fa-twitter:hover {
    color: #1da1f2 !important;
}

.fa-instagram:hover {
    color: #ce2b94 !important;
}

.fa-invision:hover {
    color: #f83263 !important;
}

.fa-github:hover {
    color: #161414 !important;
}

.fa-whatsapp:hover {
    color: #25d366 !important;
}

.fa-snapchat:hover {
    color: #fffb01 !important;
}

</style>

@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title"></h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>المستقلين</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.add-freelancer') }}</li>
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
                    <h6>{{ $freelancer->name }}</h6>
                </div>
                <div class="card-body py-md-30">


                    <div class="main">
                        <div class="card">
                            <div class="card-body">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>الأسم</td>
                                        <td>:</td>
                                        <td>{{ $freelancer->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>البريد الإلكتروني</td>
                                        <td>:</td>
                                        <td>{{ $freelancer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>الدولة</td>
                                        <td>:</td>
                                        <td>{{ $freelancer->country }}</td>
                                    </tr>
                                    <tr>
                                        <td>رقم الموبايل</td>
                                        <td>:</td>
                                        <td>{{ $freelancer->wphone }}</td>
                                    </tr>
                                    <tr>
                                        <td>رقم فودافون كاش</td>
                                        <td>:</td>
                                        <td>{{ $freelancer->vphone }}</td>
                                    </tr>
                                    <tr>
                                        <td>العمر</td>
                                        <td>:</td>
                                        <td>{{ $freelancer->age }}</td>
                                    </tr>

                                    <tr>
                                        <td>مجال العمل الرئيسي : </td>
                                        <td>:</td>
                                        <td>{{ $freelancer->main_field->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>مجال العمل الفرعي : </td>
                                        <td>:</td>
                                        <td>{{ $freelancer->sub_field->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>النوع</td>
                                        <td>:</td>
                                        <td>{{ $freelancer->type }}</td>
                                    </tr>
                                    <tr>
                                        <td>اللغة</td>
                                        <td>:</td>
                                        <td>{{ $freelancer->languages }}</td>
                                    </tr>
                                    <tr>
                                        <td>المنتجات التي يقدمها</td>
                                        <td>:</td>
                                        <td>{{ $freelancer->products }}</td>
                                    </tr>

                                    <tr>
                                        <td>السيرة الذاتية</td>
                                        <td>:</td>
                                        <td><a href="{{ $freelancer->cv }}">{{ $freelancer->cv }}</a></td>
                                    </tr>
                                        @if ($freelancer->ratings)
                                        @foreach($freelancer->ratings as $rate)

                                            <tr>
                                                <td>التقييم</td>

                                                <td>:</td>
                                                <td>

                                                    {{ $rate->rating }}

                                                </td>
                                                <td>تعليق علي التقيم : </td>
                                                <td>{{$rate->comment}}</td>
                                            </tr>

                                        @endforeach
                                            @else
                                            <tr>
                                                <td>التقييم</td>
                                                <td>:</td>
                                                <td>لايوجد تقييم</td>
                                            </tr>
                                            @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card card-Vertical card-default card-md mb-4">
                                    <div class="card-header">
                                        <h6>{{ trans('menu.add_rating') }}</h6>
                                    </div>
                                    <div class="card-body py-md-30">

                                        @include('partials._errors')

                                        <form action="{{route('store_rating' , app()->getLocale() )}}" method="POST">
                                            @csrf
                                            <div class="row">

                                                <div class="col-md-6 mb-25">
                                                    <div class="dm-select">

                                                        <select name="freelancer_id"  class="form-control ">
                                                                <option value="{{$freelancer->id}}">{{$freelancer->name}}</option>
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-25">
                                                    <input type="number" name="rating" max="10" min="1" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="التقييم" name="title" required>
                                                </div>

                                                <div class="col-md-12 mb-25">
                                                    <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" placeholder="التعليق" rows="3"></textarea>
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
                        {{-- <div class="card">
                            <div class="card-body">
                                <i class="fa fa-pen fa-xs edit"></i>
                                <div class="social-media">
                                    <span class="fa-stack fa-sm">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <span class="fa-stack fa-sm">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <span class="fa-stack fa-sm">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <span class="fa-stack fa-sm">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-invision fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <span class="fa-stack fa-sm">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <span class="fa-stack fa-sm">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-whatsapp fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <span class="fa-stack fa-sm">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-snapchat fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>
                            </div>
                        </div> --}}
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
