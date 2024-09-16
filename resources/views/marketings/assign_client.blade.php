@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.assign_client') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>التسويق بالعمولة</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.assign_client') }}</li>
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
                    <h6>{{ trans('menu.assign_client') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    @include('partials._errors')
                    <form action="{{route('store_assign_client' , app()->getLocale())}}" method="POST">
                        @csrf
                        <div class="row">


                            <div class="col-md-6 mb-25">

                                <div class="dm-select">

                                    <select name="previous_client_id" id="select-alerts89" class="form-control ">
                                        <option value=""></option>
                                        @foreach ($clients as $client )
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-md-6 mb-25">

                                <div class="dm-select">

                                    <select name="existing_client_id" id="select-alerts999" class="form-control ">
                                        <option value=""></option>
                                        @foreach ($clients as $client )
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
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
</div>
@endsection

<script>

</script>