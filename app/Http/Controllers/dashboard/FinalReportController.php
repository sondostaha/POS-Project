<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\GeneralInventory;
use App\Models\ManagementTeam;
use App\Models\Marketing;
use App\Models\Order;
use App\Models\SalesTeam;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalReportController extends Controller
{
    //التسويق بالعموله
    public function FirstStepMarketing()
    {
        $franchiseId = Auth::user()->new_franchise_id;
        $orders = Order::where('new_franchise_id', $franchiseId)
            ->where('status' ,'مسلم')
            ->where('status_inventory' ,'لم يتم')
            ->with(['mainField', 'user'])
            ->get();
        $freelances =  $orders->sum('fvalue');
        $totalOrdervalue = $orders->sum('cvalue');
        $marketing = Marketing::where('status' ,'enable')->first();
        $marketing == null ? $getMarketingValue = 0 : $getMarketingValue = intval($marketing->level1);
        $marketingValue = $totalOrdervalue * ($getMarketingValue/100);
        $finalValue = $freelances + $marketingValue;
        $fainlTotalOrderValue = $totalOrdervalue - $finalValue;
        return ['orders' =>$orders,'totalOrder'=>$totalOrdervalue,'freelances'=>$freelances,'marketingValue'=>$marketingValue,'finalTotalOrderValue'=>$fainlTotalOrderValue];
    }
//وكلاء المبيعات
public function SecStepSalesTeam()
{
    $markting = $this->FirstStepMarketing();
    $fainlTotalOrderValue = $markting['finalTotalOrderValue'];
    $franchiseId = Auth::user()->new_franchise_id;
    $sales_team = SalesTeam::where('new_franchise_id',$franchiseId)->first();
    $sales_agent = $sales_team->sales_agent;

    $sales_officer = $sales_team->sales_officer;

    $calcOfSalesAgent = ($fainlTotalOrderValue * ($sales_agent/100)) + $sales_team->sales_agent_salary;
    $calcOfSalesOfficer = ($fainlTotalOrderValue * ($sales_officer/100)) + $sales_team->sales_officer_salary;

    $salesValue = $calcOfSalesAgent + $calcOfSalesOfficer;
    $finalValueOfOrder = $fainlTotalOrderValue - $salesValue;
    return  ['sales_agent' =>$calcOfSalesAgent,'sales_officer' =>$calcOfSalesOfficer,'finalValueOfOrder' => $finalValueOfOrder];

}
public function ThStepSetting()
{
    $salesTeam = $this->SecStepSalesTeam();
    $valueOfTotalOrder = $salesTeam['finalValueOfOrder'];
    $setting = Setting::get();
    $salary = $setting->sum('salary');
    $settingCost = $setting->sum('cost');
    $valueOfSetting = ($valueOfTotalOrder * ($settingCost/100)) + $salary;
    $finalValueOfSetting = $valueOfTotalOrder - $valueOfSetting;
    return ['setting' => $valueOfSetting,'finalValueOfSetting' => $finalValueOfSetting];
}
public function FourthStepManagmentTeam()
{
    $setting = $this->ThStepSetting();
    $valueOfTotalOrder = $setting['finalValueOfSetting'];
    $managementTeam = ManagementTeam::first();
    $sales_manager = ($valueOfTotalOrder *($managementTeam->sales_manager/100)) +$managementTeam->sales_manager_salary; ;

    $marketing_manager = ($valueOfTotalOrder *($managementTeam->marketing_manager/100)) + $managementTeam->marketing_manager_salary;

    $technical_director =($valueOfTotalOrder *($managementTeam->technical_director/100))+ $managementTeam->technical_director_salary;
    $CFO = ($valueOfTotalOrder *($managementTeam->CFO/100)) + $managementTeam->CFO_salary;
    $CEO = ($valueOfTotalOrder *($managementTeam->CEO/100)) + $managementTeam->CEO_salary;
    $hr_managerDues =  ($valueOfTotalOrder *($managementTeam->hr_manager/100)) + $managementTeam->hr_manager_salary;
    $totalOfManagementTeam = $sales_manager + $technical_director + $CFO + $CEO + $hr_managerDues + $marketing_manager;
//    $valueOfManageTeam = $valueOfTotalOrder * ($totalOfManagementTeam/100);
    $finalValueOfManageTeam = $valueOfTotalOrder - $totalOfManagementTeam;
    return ['sales_manager' => $sales_manager,'marketing_manager' =>$marketing_manager,'technical_director'=>$technical_director,'CFO'=>$CFO,'CEO'=>$CEO,'hr_manager'=>$hr_managerDues,'finalValueOfManageTeam' => $totalOfManagementTeam,'finalValueOfOrders' => $finalValueOfManageTeam];
}
public function finalNetProfits()
{
    $managementTeam = $this->FourthStepManagmentTeam();
    $netProfit = $managementTeam['finalValueOfOrders'];
    return ['netProfit' => $netProfit];
}
private  function storeGeneralInventory ($totalRevenue,$netProfit,$totalFreelancerDues,$affiliateMarketersCommission,$sales_officer,$agentSalesCommission,$salesManagerDues,$marketing_manager,$technicalDirectorDues,$financialOfficerDues,$hr_managerDues,$ceoRemuneration,$totalSetting,$franchiseId,$main_field)
    {

        $inventory = GeneralInventory::where('new_franchise_id', $franchiseId)
            ->where('totalSetting',$totalSetting)
            ->where('totalRevenue',$totalRevenue)
            ->first();
        $last_inventor = GeneralInventory::latest()->first();

        if(empty($inventory) ){
            $inventory = GeneralInventory::create([
                'totalRevenue' => $totalRevenue,
                'netProfit' => $netProfit,
                'totalFreelancerDues' => $totalFreelancerDues,
                'affiliateMarketersCommission' => $affiliateMarketersCommission,
                'agentSalesCommission' => $agentSalesCommission,
                'salesOfficerCommission' => $sales_officer,
                'salesManagerDues' => $salesManagerDues,
                'marketing_manager' => $marketing_manager,
                'technicalDirectorDues' => $technicalDirectorDues,
                'financialOfficerDues' => $financialOfficerDues,
                'hr_managerDues' => $hr_managerDues,
                'ceoRemuneration' => $ceoRemuneration,
                'totalSetting' => $totalSetting,
                'new_franchise_id' => $franchiseId,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'main_field' => $main_field,

            ]);

        }else
        {
            $delete_inventory = $inventory;
            if($last_inventor->id != $delete_inventory->id){
                $inventory = GeneralInventory::create([
                    'totalRevenue' => $totalRevenue,
                    'netProfit' => $netProfit,
                    'totalFreelancerDues' => $totalFreelancerDues,
                    'affiliateMarketersCommission' => $affiliateMarketersCommission,
                    'agentSalesCommission' => $agentSalesCommission,
                    'salesOfficerCommission' => $sales_officer,
                    'salesManagerDues' => $salesManagerDues,
                    'marketing_manager' => $marketing_manager,
                    'technicalDirectorDues' => $technicalDirectorDues,
                    'financialOfficerDues' => $financialOfficerDues,
                    'hr_managerDues' => $hr_managerDues,
                    'ceoRemuneration' => $ceoRemuneration,
                    'totalSetting' => $totalSetting,
                    'new_franchise_id' => $franchiseId,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'main_field' => $main_field,
                ]);
                $delete_inventory->delete();
            }
            else
            {
                $inventory = $last_inventor;
            }

        }

        if($inventory){
            return $inventory;
        }
        return false;
    }

public function generateInventoryReport()
{
    $firstStep = $this->FirstStepMarketing();
    $secStep = $this->SecStepSalesTeam();
    $thirdStep = $this->ThStepSetting();
    $fourthStep = $this->FourthStepManagmentTeam();
    $finalNetProfits = $this->finalNetProfits();
    $orders = $firstStep['orders'];
    $franchiseId = Auth::user()->new_franchise_id;

    if(!empty($orders->first())){
        $totalSetting = $thirdStep['setting'];
        $totalRevenue = $firstStep['totalOrder'];
        $totalFreelancerDues = $firstStep['freelances'];

        $affiliateMarketersCommission = $firstStep['marketingValue'];
        $profit = $totalRevenue - $totalFreelancerDues;
        $agentSalesCommission = $secStep['sales_agent'];
        $sales_officer = $secStep['sales_officer'];
        $marketing_manager = $fourthStep['marketing_manager'];
        $salesManagerDues = $fourthStep['sales_manager'];
        $technicalDirectorDues = $fourthStep['technical_director'];
        $financialOfficerDues = $fourthStep['CFO'];
        $ceoRemuneration = $fourthStep['CEO'];
        $hr_managerDuesDues = $fourthStep['hr_manager'];

// الميزانيات
        $netProfit = $finalNetProfits['netProfit'];
        $reportData = [
            'إجمالي الإيرادات' => $totalRevenue,
            'مستحقات المستقلين' => $totalFreelancerDues,
            'عمولة المسوقين بالعمولة' => $affiliateMarketersCommission,
            'عموله وكيل المبيعات' => $agentSalesCommission,
            'عموله مسؤول المبيعات' => $sales_officer,
            'اجمالي الميزانيات' => $totalSetting,
            'مستحقات مدير المبيعات' => $salesManagerDues,
            'مستحقات المدير التقني' => $technicalDirectorDues,
            'مستحقات المدير المالي' => $financialOfficerDues,
            'مكافأة المدير التنفيذي' => $ceoRemuneration,
            'مكافأة مدير التسويق' => $marketing_manager,
            'مكافاه مدير الموارد البشريه' => $hr_managerDuesDues,
            'صافي الربح' => $netProfit,
        ];
        $main_field = [] ;
        $main_field =$orders->groupBy('main_field_id')->map(function ($fieldOrders) {
            return [
                'title' => $fieldOrders->first()->mainField->title,
                'value' => $fieldOrders->sum('cvalue')
            ];
        });
        $chartData = $this->prepareChartData($orders, $reportData);
        $inventory = $this->storeGeneralInventory($totalRevenue,$netProfit,$totalFreelancerDues,$affiliateMarketersCommission,$agentSalesCommission,$sales_officer,$salesManagerDues,$marketing_manager,$technicalDirectorDues,$financialOfficerDues,$hr_managerDuesDues,$ceoRemuneration,$totalSetting,$franchiseId,$main_field);
        $orders->map(function ($value){
            $value->update(['status_inventory' => 'تم' ,'inventory_date' => Carbon::now()->format('Y-m-d H:i:s')]);
        });
        $date= $inventory->created_at;
        $title = "التقرير الشامل للشركة";
        $description = "تقرير مفصل يشمل جميع الجوانب المالية للشركة";

        return view('reports.comprehensive_inventory', compact('reportData', 'chartData', 'title', 'description','date'));
    }
    $notification = array(
        'message' => 'لا يوجد طلبات للجرد',
        'alert-type' => 'error'
    );

    return back()->with($notification);

}
public function getAllInventories()
    {
        $title = 'جميع الجرود';
        $description = 'عرض جميع الجرود';
        $inventories = GeneralInventory::all();
        return view('reports.all_inventories', compact('description','title','inventories'));
    }
    private function prepareChartData($orders, $reportData)
    {
        return [
            'revenueByField' => $orders->groupBy('main_field_id')->map(function ($fieldOrders) {
                return [
                    'title' => $fieldOrders->first()->mainField->title,
                    'value' => $fieldOrders->sum('cvalue')
                ];
            }),
            'expenseBreakdown' => collect($reportData)->except(['إجمالي الإيرادات', 'صافي الربح'])->toArray(),
            'profitOverview' => [
                'إجمالي الإيرادات' => $reportData['إجمالي الإيرادات'],
                'إجمالي المصروفات' => $reportData['إجمالي الإيرادات'] - $reportData['صافي الربح'],
                'صافي الربح' => $reportData['صافي الربح'],
            ],
        ];
    }
    public function showInventor($language,$id)
    {
        $general_inventory = GeneralInventory::findOrFail($id);
        $reportData = [
            'إجمالي الإيرادات' => $general_inventory->totalRevenue,
            'مستحقات المستقلين' => $general_inventory->totalFreelancerDues,
            'عمولة المسوقين بالعمولة' => $general_inventory->affiliateMarketersCommission,
            'عمولة وكيل المبيعات' => $general_inventory->agentSalesCommission,
            'عموله مسؤول المبيعات' => $general_inventory->salesOfficerCommission,
            'اجمالي الميزانيات' => $general_inventory->totalSetting,

            'مستحقات مدير المبيعات' => $general_inventory->salesManagerDues,
            'مستحقات المدير التقني' => $general_inventory->technicalDirectorDues,
            'مستحقات المدير المالي' => $general_inventory->financialOfficerDues,
            'مكافأة المدير التنفيذي' => $general_inventory->ceoRemuneration,
            'مدير التسويق' => $general_inventory->marketing_manager,
            'مدير الموارد البشريه' =>$general_inventory->hr_managerDues,
            'صافي الربح' => $general_inventory->netProfit,

        ];
        $date= $general_inventory->created_at;

        $datene =collect(json_decode($general_inventory->main_field));

        $chartData = [];
        $chartData['revenueByField']  = $datene->map( function($item){
            return [
                'title'=>$item->title,
                'value' => $item->value,
            ];

        });;
        $chartData['expenseBreakdown'] = collect($reportData)->except(['إجمالي الإيرادات', 'صافي الربح'])->toArray();

        $chartData['profitOverview'] = [
            'إجمالي الإيرادات' => $reportData['إجمالي الإيرادات'],
            'إجمالي المصروفات' => $reportData['إجمالي الإيرادات'] - $reportData['صافي الربح'],
            'صافي الربح' => $reportData['صافي الربح'],
        ];

        $title = "التقرير الشامل للشركة";
        $description = "تقرير مفصل يشمل جميع الجوانب المالية للشركة";

        return view('reports.show_inventory', compact('reportData',  'chartData','title', 'description','date'));

    }

}
