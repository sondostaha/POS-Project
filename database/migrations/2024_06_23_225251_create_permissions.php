<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // يمكنك إضافة صلاحيات لكل قسم بالطريقة التالية

$sections = ['المستخدمين' , 'الصلاحيات' , 'العملاء' , 'الفرانشيز' , 'مجالات العمل' , 'المستقلين' , 'الطلبات' , 'التسوق بالعمولة' , 'التقرير المالي' , 'مصاريف التشغيل' , 'اعدادات الجرد'];

        foreach ($sections as $section) {
            Permission::create(['name' => "عرض $section"]);
            Permission::create(['name' => "اضافة $section"]);
            Permission::create(['name' => "تعديل $section"]);
            Permission::create(['name' => "حذف $section"]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
