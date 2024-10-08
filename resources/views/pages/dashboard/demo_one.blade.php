@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="crm mb-25">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">{{ trans('page_title.dashboard') }}</h4>

                </div>
            </div>
            @include('components.dashboard.demo_one.overview_cards')
            @include('components.dashboard.demo_one.sales_report')
            @include('components.dashboard.demo_one.sales_growth')
            @include('components.dashboard.demo_one.sales_location')
            @include('components.dashboard.demo_one.top_sale_products')
            @include('components.dashboard.demo_one.browser_state')
            
        </div>
    </div>
</div>
@endsection