@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.add_rating') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>{{ trans('menu.ratings') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.add_rating') }}</li>
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
                    <h6>{{ trans('menu.add_rating') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    
            <form action="{{route('store_rating' , app()->getLocale() )}}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-md-6 mb-25">
                        <div class="dm-select">

                            <select name="freelancer_id" id="select-alerts3" class="form-control ">
                                <option value=""></option>
                                @foreach ($freelancers as $freelancer )
                                <option value="{{$freelancer->id}}">{{$freelancer->name}}</option>
                                @endforeach
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
</div>

@endsection