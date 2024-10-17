<div class="table-responsive">
  <table class="table text-md-nowrap mt-2" id="example1">
    <thead>
      <tr>
        <th class="wd-15p border-bottom-0 " >id</th>
        <th class="wd-15p border-bottom-0 " >الأسم</th>
        <th class="wd-15p border-bottom-0 " >البريد الإلكتروني</th>
        <th class="wd-10p border-bottom-0 " >السن</th>
        <th class="wd-15p border-bottom-0 " >البلد</th>
        <th class="wd-15p border-bottom-0 " >النوع</th>
        {{-- <th class="wd-10p border-bottom-0 " >الكورس</th>
        <th class="wd-10p border-bottom-0 " >اللغة</th> --}}
        <th class="wd-10p border-bottom-0 " >الشهادة العلمية ومجال العمل الأساسي</th>
        <th class="wd-10p border-bottom-0 " >مجالات العمل الرئيسية عن بعد</th>
        <th class="wd-10p border-bottom-0 " >المنتجات</th>
        <th class="wd-10p border-bottom-0 " >اللغات</th>
        <th class="wd-10p border-bottom-0 " >رقم الواتساب او الفيس بوك</th>
        <th class="wd-10p border-bottom-0 " >رقم فودافون كاش</th>
        <th class="wd-10p border-bottom-0 " >نماذج الأعمال</th>
        <th class="wd-10p border-bottom-0 " >العمليات</th>
      </tr>
    </thead>
    <tbody>
      @foreach ( $freelancers as $freelancer )
      <tr>
        <td >{{$freelancer->id}}</td>
        <td >{{$freelancer->name}}</td>
        <td >{{$freelancer->email}}</td>
        <td >{{$freelancer->age}}</td>
        <td >{{$freelancer->country}}</td>
        <td >{{$freelancer->type}}</td>
        <td >{{$freelancer->certificate}}</td>
        <td >{{$freelancer->field_type}}</td>
        <td >{{$freelancer->products}}</td>
        <td >{{$freelancer->languages}}</td>
        <td >{{$freelancer->wphone}}</td>
        <td >{{$freelancer->vphone}}</td>
        <td >{{$freelancer->cv}}</td>

        <td >
          <a href="" title = "تعديل الطالب" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

          <a href="" title="حذف الطالب" class="btn btn-primary btn-sm " ><i class="fa fa-trash"></i></a>

          <a href="" title = "اضافة الطالب لكورس" class="btn btn-primary btn-sm mt-2" ><i class="fa fa-plus"></i></a>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
</div>
