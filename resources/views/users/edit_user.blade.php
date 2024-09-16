@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.edit_user') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>{{trans('menu.users')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.edit_user') }}</li>
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
                    <h6>{{ trans('menu.edit_user') }}</h6>
                </div>
                <div class="card-body py-md-30">

                    <!--@include('partials._errors')-->
                    <form action="{{route('update_users' , [app()->getLocale() , $user->id])}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-25">
                                <input type="text" name="username" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="اللقب" value="{{$user->username}}">
                            </div>
                            @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                            <div class="col-md-6 mb-25">
                                <input type="text" name="name" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="الأسم" value="{{$user->name}}">
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            <div class="col-md-6 mb-25">
                                <input type="text" name="email" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="البريد الإلكتروني" value="{{$user->email}}">
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <div class="col-md-6 mb-25">
                                <input type="password" name="password" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="كلمة السر" value="">
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            <div class="col-md-6 mb-25">
                                <select name="role" id="countryOption97676" class="try form-control px-15 " onchange="toggleManagerSection()">
                                    <option value="">الرتبة</option>
                                    @foreach ($roles as $role )

                                    <option value="{{$role->name}}">{{$role->name}}</option>

                                    @endforeach

                                </select>
                            </div>
                            @if ($errors->has('role'))
                                <span class="text-danger">{{ $errors->first('role') }}</span>
                            @endif
                            <div class="col-md-6 mb-25" id="manager-section" style="display:none;">
                                <select name="manager_id"  class="form-control px-15" title="اختر مسؤول المبيعات">
                                    <option value="">اختر مسؤول المبيعات</option>
                                    @foreach ($managers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            @if ($errors->has('manager_id'))
                                <span class="text-danger">{{ $errors->first('manager_id') }}</span>
                            @endif
                            <div class="col-md-6 mb-25">
                                <input type="text" name="about" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="النبذة الشخصية" value="{{$user->about}}">
                            </div>
                            @if ($errors->has('about'))
                                <span class="text-danger">{{ $errors->first('about') }}</span>
                            @endif
                            <div class="col-md-6 mb-25">
                                <input type="text" name="phone" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="رقم الموبايل" value="{{$user->phone}}">
                            </div>
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                            <div class="col-md-6 mb-25">
                                <input type="text" name="wphone" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="واتساب" value="{{$user->wphone}}">
                            </div>
                                                        @if ($errors->has('wphone'))
                                <span class="text-danger">{{ $errors->first('wphone') }}</span>
                            @endif
                            <div class="col-md-6 mb-25">
                                <input type="text" name="facebook" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="فيسبوك" value="{{$user->facebook}}">
                            </div>
                                                        @if ($errors->has('facebook'))
                                <span class="text-danger">{{ $errors->first('facebook') }}</span>
                            @endif
                            <div class="col-md-6 mb-25">
                                <input type="text" name="pay" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="بيانات الدفع" value="{{$user->pay}}">
                            </div>
                            @if ($errors->has('pay'))
                                <span class="text-danger">{{ $errors->first('pay') }}</span>
                            @endif
                            <div class="col-md-6 mb-25">
                                <input type="text" name="vcashe" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="فودافون كاش" value="{{$user->vcashe}}">
                            </div>
                            @if ($errors->has('vcashe'))
                                <span class="text-danger">{{ $errors->first('vcashe') }}</span>
                            @endif

                            <div class="col-md-6 mb-25">
                                <input type="text" name="card" class="form-control ih-medium ip-gray radius-xs b-light px-15" placeholder="الرقم القومي" value="{{$user->card}}">
                            </div>
                            @if ($errors->has('card'))
                                <span class="text-danger">{{ $errors->first('card') }}</span>
                            @endif
                            
                            <div class="col-md-12">
                                <div class="layout-button mt-0">
                                    <button type="submit" class="btn btn-primary btn-default btn-squared px-30">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script>
                        function toggleManagerSection() {
                            var roleSelect = document.querySelector('.try'); // Selects the first element with class 'try'
                            var managerSection = document.getElementById('manager-section');
                        
                            if (roleSelect.value === 'وكيل مبيعات') {
                                managerSection.style.display = 'block';
                            } else {
                                managerSection.style.display = 'none';
                            }
                        }
                        </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection