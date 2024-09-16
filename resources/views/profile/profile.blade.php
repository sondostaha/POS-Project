    <style>





    </style>

    @section('title',$title)
    @section('description',$description)
    @extends('layout.app')
    @section('content')
    <div class="container py-5">



        <div class="row">
          <div class="col-lg-4">
            <div class="card mb-4">
              <div class="card-body text-center">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                  class="rounded-circle img-fluid" style="width: 150px;">
                <h5 class="my-3">{{ Auth::user()->name }} <a href="" type="button" data-bs-toggle="modal" data-bs-target="#name"><i class="fa-solid fa-pen-to-square"></i></a></h5>
                <p class="text-muted mb-1">{{ Auth::user()->role }}</p>
                {{-- <p class="text-muted mb-4">Bay Area, San Francisco, CA</p> --}}
                <div class="d-flex justify-content-center mb-2">
                  <button  type="button" data-bs-toggle="modal" data-bs-target="#pass" class="btn btn-primary">تغيير كلمة السر</button>
                </div>
              </div>
            </div>
            <div class="card mb-4 mb-lg-0">
              <div class="card-body p-0">
                <ul class="list-group list-group-flush rounded-3">
                  <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <i class="fa-solid fa-phone fa-lg" style="color: #333333;"></i>
                    <a href="tel:{{ Auth::user()->phone }}">{{ Auth::user()->phone }} </a><a href="" type="button" data-bs-toggle="modal" data-bs-target="#phone"><i class="fa-solid fa-pen-to-square"></i></a>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <i class="fab fa-whatsapp fa-lg" style="color: #2bdb2b;"></i>
                    <a href="https://wa.me/{{ Auth::user()->wphone }}">{{ Auth::user()->wphone }} </a> <a href="" type="button" data-bs-toggle="modal" data-bs-target="#whatsapp"><i class="fa-solid fa-pen-to-square"></i></a>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                    <a href="{{ Auth::user()->facebook }}">{{ Auth::user()->facebook }} </a><a href="" type="button" data-bs-toggle="modal" data-bs-target="#facebook"><i class="fa-solid fa-pen-to-square"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">اليوزر نيم</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">{{ Auth::user()->username }}</p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">نبذه شخصية</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">{{ Auth::user()->about }} <a href="" type="button" data-bs-toggle="modal" data-bs-target="#about"><i class="fa-solid fa-pen-to-square"></i></a></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">رقم الموبايل</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">{{ Auth::user()->phone }} <a href="" type="button" data-bs-toggle="modal" data-bs-target="#phone"><i class="fa-solid fa-pen-to-square"></i></a></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">الرتبة</p>
                  </div>
                  <div class="col-sm-9">
                    @foreach(Auth::user()->roles as $role)
                    <p class="text-muted mb-0">{{ $role->name }}</p>
                    @endforeach
                    {{-- @foreach ($user->roles as $role)
                    <span>{{ $role->name }}</span>
                @endforeach --}}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">فودافون كاش</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">{{ Auth::user()->vcashe }} <a href="" type="button" data-bs-toggle="modal" data-bs-target="#vcashe"><i class="fa-solid fa-pen-to-square"></i></a></p>
                  </div>
                </div>

                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">الرقم القومي</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">{{ Auth::user()->card }} <a href=""  type="button" data-bs-toggle="modal" data-bs-target="#card"><i class="fa-solid fa-pen-to-square"></i></a></p>
                  </div>
                </div>
                <hr>
              </div>
            </div>
            {{-- <div class="row">
              <div class="col-md-6">
                <div class="card mb-4 mb-md-0">
                  <div class="card-body">
                    <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                    </p>
                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                    <div class="progress rounded mb-2" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card mb-4 mb-md-0">
                  <div class="card-body">
                    <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                    </p>
                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                    <div class="progress rounded" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                    <div class="progress rounded mb-2" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
      </div>

@php
   $id =  Auth::user()->id ;
@endphp

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.edit_email')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="{{route('edit_email', [app()->getLocale() , $id])}}" method="POST" >
                    @csrf
                    <div class="wrapper">
                        <input type="text" required class="form-control" name="email" placeholder="البريد الإلكتروني">
                        {{-- <input type="hidden" class="form-control" name="id" value="{{ $id }}"> --}}
                        <br>
                      </div>
                      <button type="submit" class="btn btn-primary">تعديل</button>
                </form>




            </div>

          </div>
        </div>
    </div>


    <div class="modal fade" id="about" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.edit_about')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="exampleModalLabel" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="{{route('edit_about', [app()->getLocale() , $id])}}" method="POST" >
                    @csrf
                    <div class="wrapper">
                        <input type="text" required class="form-control" name="about" placeholder="النبذة الشخصية">
                        {{-- <input type="hidden" class="form-control" name="id" value="{{ $id }}"> --}}
                        <br>
                      </div>
                      <button type="submit" class="btn btn-primary">تعديل</button>
                </form>




            </div>

          </div>
        </div>
    </div>


    <div class="modal fade" id="phone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.edit_phone')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="exampleModalLabel" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="{{route('edit_phone', [app()->getLocale() , $id])}}" method="POST" >
                    @csrf
                    <div class="wrapper">
                        <input type="text" required class="form-control" name="phone" placeholder="رقم الموبايل">
                        {{-- <input type="hidden" class="form-control" name="id" value="{{ $id }}"> --}}
                        <br>
                      </div>
                      <button type="submit" class="btn btn-primary">تعديل</button>
                </form>




            </div>

          </div>
        </div>
    </div>

    <div class="modal fade" id="vcashe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.edit_vcash')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="exampleModalLabel" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="{{route('edit_vcash', [app()->getLocale() , $id])}}" method="POST" >
                    @csrf
                    <div class="wrapper">
                        <input type="text" required class="form-control" name="vcashe" placeholder="فودافون كاش">
                        {{-- <input type="hidden" class="form-control" name="id" value="{{ $id }}"> --}}
                        <br>
                      </div>
                      <button type="submit" class="btn btn-primary">تعديل</button>
                </form>




            </div>

          </div>
        </div>
    </div>


    <div class="modal fade" id="card" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.edit_card')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="exampleModalLabel" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="{{route('edit_card', [app()->getLocale() , $id])}}" method="POST" >
                    @csrf
                    <div class="wrapper">
                        <input type="text" required class="form-control" name="card" placeholder="الرقم القومي">
                        {{-- <input type="hidden" class="form-control" name="id" value="{{ $id }}"> --}}
                        <br>
                      </div>
                      <button type="submit" class="btn btn-primary">تعديل</button>
                </form>




            </div>

          </div>
        </div>
    </div>

    <div class="modal fade" id="facebook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.edit_facebook')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="exampleModalLabel" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="{{route('edit_facebook', [app()->getLocale() , $id])}}" method="POST" >
                    @csrf
                    <div class="wrapper">
                        <input type="text" required class="form-control" name="facebook" placeholder="الفيسبوك">
                        {{-- <input type="hidden" class="form-control" name="id" value="{{ $id }}"> --}}
                        <br>
                      </div>
                      <button type="submit" class="btn btn-primary">تعديل</button>
                </form>

            </div>

          </div>
        </div>
    </div>

    <div class="modal fade" id="whatsapp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.edit_wphone')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="exampleModalLabel" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="{{route('edit_wphone', [app()->getLocale() , $id])}}" method="POST" >
                    @csrf
                    <div class="wrapper">
                        <input type="text" required class="form-control" name="wphone" placeholder="واتساب">
                        {{-- <input type="hidden" class="form-control" name="id" value="{{ $id }}"> --}}
                        <br>
                      </div>
                      <button type="submit"  class="btn btn-primary">تعديل</button>
                </form>

            </div>

          </div>
        </div>
    </div>

    <div class="modal fade" id="phone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.edit_phone')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="exampleModalLabel" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="{{route('edit_phone', [app()->getLocale() , $id])}}" method="POST" >
                    @csrf
                    <div class="wrapper">
                        <input type="text" required class="form-control" name="phone" placeholder="رقم الموبايل">
                        {{-- <input type="hidden" class="form-control" name="id" value="{{ $id }}"> --}}
                        <br>
                      </div>
                      <button type="submit" class="btn btn-primary">تعديل</button>
                </form>

            </div>

          </div>
        </div>
    </div>

    <div class="modal fade" id="name" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.edit_name')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="exampleModalLabel" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="{{route('edit_name', [app()->getLocale() , $id])}}" method="POST" >
                    @csrf
                    <div class="wrapper">
                        <input type="text" required class="form-control" name="name" placeholder="الأسم">
                        {{-- <input type="hidden" class="form-control" name="id" value="{{ $id }}"> --}}
                        <br>
                      </div>
                      <button type="submit" class="btn btn-primary">تعديل</button>
                </form>

            </div>

          </div>
        </div>
    </div>


    <div class="modal fade" id="pass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.edit_password')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="exampleModalLabel" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="{{route('edit_password', [app()->getLocale() , $id])}}" method="POST" >
                    @csrf
                    <div class="wrapper d-flex mb-4">
                        <input type="password" required class="form-control" name="old_password" placeholder=" كلمة السر الحالية">
                        <input type="password" required class="form-control ms-4" name="password" placeholder=" كلمة السر الجديدة">
                        {{-- <input type="hidden" class="form-control" name="id" value="{{ $id }}"> --}}
                        <br>
                    </div>
                      <button type="submit" class="btn btn-primary">تعديل</button>
                </form>

            </div>

          </div>
        </div>
    </div>





    @endsection
