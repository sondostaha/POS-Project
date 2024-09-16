<?php

namespace App\Exports;

use App\Models\Freelancer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FreelancerExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Freelancer::getAllFreelancer());
    }

    public function headings():array{
            return ['Id' ,'الأسم' , 'السن' , 'البلد' , 'النوع' , 'الشهادة العلمية' , 'مجال العمل الرئيسي' , 'مجال العمل الفرعي' , 'المنتجات' , 'اللغات' , 'رقم الواتساب' , 'رقم فودافون كاش' ,'البريد الإلكتروني' , 'نماذج الأعمال' , 'المستخدم' ,'تاريخ الإضافة'];

    }
}
