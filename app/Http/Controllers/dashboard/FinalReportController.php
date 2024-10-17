<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientAttribution;
use App\Models\FreelancerOrders;
use App\Models\GeneralInventory;
use App\Models\ManagementTeam;
use App\Models\Marketing;
use App\Models\Order;
use App\Models\SalesTeam;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalReportController extends Controller
{
    //التسويق بالعمولة
    public function FirstStepMarketing()
    {
        $franchiseId = Auth::user()->new_franchise_id;
        $orders = Order::where('new_franchise_id', $franchiseId)
            ->where('status' ,'مسلم')
            ->where('status_inventory' ,'لم يتم')
            ->with(['mainField', 'user'])
            ->get();
        $order_ids = $orders->pluck('id');
        $freelances =  $orders->sum('fvalue');
        $totalOrdervalue = $orders->sum('cvalue');
        $marketing = Marketing::where('status' ,'enable')->first();
        $cleintsAtrrs = ClientAttribution::whereIn('existing_client_id',$orders->pluck('client_id'))->with('previousClient')->get();
        // dd(empty($cleintsAtrrs->first()));
        if(!empty($cleintsAtrrs->first()))
        {
            $marketing == null ? $getMarketingValue = 0 : $getMarketingValue = intval($marketing->level1);
            $marketingValue = $totalOrdervalue * ($getMarketingValue/100);
        }else
        {
            $marketingValue = 0 ;
        }

        $finalValue = $freelances + $marketingValue;
        $fainlTotalOrderValue = $totalOrdervalue - $finalValue;
        return ['orders' =>$orders,'totalOrder'=>$totalOrdervalue,'freelances'=>$freelances,'marketingValue'=>$marketingValue,'finalTotalOrderValue'=>$fainlTotalOrderValue,'order_ids' =>$order_ids];
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
    // dd($calcOfSalesOfficer);
    $salesValue = $calcOfSalesAgent + $calcOfSalesOfficer;
    $finalValueOfOrder = $fainlTotalOrderValue - $salesValue;
    return  ['sales_agent' =>$calcOfSalesAgent,'sales_officer' =>$calcOfSalesOfficer,'finalValueOfOrder' => $finalValueOfOrder,'orders' => $markting['orders']];

}
public function ThStepSetting()
{
    $salesTeam = $this->SecStepSalesTeam();
    $orders = $salesTeam['orders'];
    $valueOfTotalOrder = $salesTeam['finalValueOfOrder'];
    $setting = Setting::whereIn('new_franchise_id',$orders->pluck('new_franchise_id'))->get();
    $salary = $setting->sum('salary');
    $settingCost = $setting->sum('cost');
    $valueOfSetting = ($valueOfTotalOrder * ($settingCost/100)) + $salary;
//    dd($valueOfSetting);

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
private  function storeGeneralInventory ($order_ids,$totalRevenue,$netProfit,$totalFreelancerDues,$affiliateMarketersCommission,$sales_officer,$agentSalesCommission,$salesManagerDues,$marketing_manager,$technicalDirectorDues,$financialOfficerDues,$hr_managerDuesDues,$ceoRemuneration,$totalSetting,$franchiseId,$main_field)
    {

//         dd($totalSetting);
        $inventory = GeneralInventory::where('new_franchise_id', $franchiseId)
            ->where('totalSetting',$totalSetting)
            ->where('totalRevenue',$totalRevenue)
            ->first();
        $last_inventor = GeneralInventory::latest()->first();

        if(empty($inventory) ){
            $inventory = GeneralInventory::create([
                'orders_id' => json_encode($order_ids),
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
                'hr_managerDues' => $hr_managerDuesDues,
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
                    'orders_id' => json_encode($order_ids),
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
                    'hr_managerDues' => $hr_managerDuesDues,
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
    $order_ids =$firstStep['order_ids'];
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
            'id' => $order_ids,
            'إجمالي الإيرادات' => $totalRevenue,
            'مستحقات المستقلين' => $totalFreelancerDues,
            'عمولة المسوقين بالعمولة' => $affiliateMarketersCommission,
            'عمولة وكيل المبيعات' => $agentSalesCommission,
            'عمولة مسؤول المبيعات' => $sales_officer,
            'اجمالي الميزانيات' => $totalSetting,
            'مستحقات مدير المبيعات' => $salesManagerDues,
            'مستحقات المدير التقني' => $technicalDirectorDues,
            'مستحقات المدير المالي' => $financialOfficerDues,
            'مستحقات المدير التنفيذي' => $ceoRemuneration,
            'مستحقات مدير التسويق' => $marketing_manager,
            'مستحقات مدير الموارد البشرية' => $hr_managerDuesDues,
            'صافي الربح' => $netProfit,
        ];
//        dd($reportData);
        $main_field = [] ;
        $main_field =$orders->groupBy('main_field_id')->map(function ($fieldOrders) {
            return [
                'title' => $fieldOrders->first()->mainField->title,
                'value' => $fieldOrders->sum('cvalue')
            ];
        });
        $chartData = $this->prepareChartData($orders, $reportData);
        $inventory = $this->storeGeneralInventory($order_ids,$totalRevenue,$netProfit,$totalFreelancerDues,$affiliateMarketersCommission,$sales_officer,$agentSalesCommission,$salesManagerDues,$marketing_manager,$technicalDirectorDues,$financialOfficerDues,$hr_managerDuesDues,$ceoRemuneration,$totalSetting,$franchiseId,$main_field);
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
        $user = Auth::user();
        $inventories = GeneralInventory::where('new_franchise_id' ,$user->new_franchise_id)->get();
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
            'id' => $general_inventory->id,
            'إجمالي الإيرادات' => $general_inventory->totalRevenue,
            'مستحقات المستقلين' => $general_inventory->totalFreelancerDues,
            'عمولة المسوقين بالعمولة' => $general_inventory->affiliateMarketersCommission,
            'عمولة وكيل المبيعات' => $general_inventory->agentSalesCommission,
            'عمولة مسؤول المبيعات' => $general_inventory->salesOfficerCommission,
            'اجمالي الميزانيات' => $general_inventory->totalSetting,
            'مستحقات مدير المبيعات' => $general_inventory->salesManagerDues,
            'مستحقات المدير التقني' => $general_inventory->technicalDirectorDues,
            'مستحقات المدير المالي' => $general_inventory->financialOfficerDues,
            'مستحقات المدير التنفيذي' => $general_inventory->ceoRemuneration,
            'مستحقات مدير التسويق' => $general_inventory->marketing_manager,
            'مستحقات مدير الموارد البشرية' =>$general_inventory->hr_managerDues,
            'صافي الربح' => $general_inventory->netProfit,

        ];
        // dd($reportData);
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

    public function freelancesDetails($id)
    {
        $inventories = GeneralInventory::findOrFail($id);

        $orders = order::whereIn('id',json_decode($inventories->orders_id))->get();
//dd($orders);

        // foreach($orders as $o)
        return ['orders' => $orders ,'inventories' => $inventories];
    }
    public function freelancesDetailsView($language,$id)
    {
        $title = 'مستحقات المستقلين';
        $description = 'مستحقات المستقلين';
        $free = $this->freelancesDetails($id);
        $orders= $free['orders'];

        return view('reports.details.freelancers',compact('orders','title','description'));

    }
    public function marketingDetails($id)
    {
        $inventories = $this->freelancesDetails($id);

        $orders = Order::whereIn('id',json_decode($inventories['inventories']->orders_id))->with('client')->get();
        // dd($orders);
        $marketing = Marketing::where('status','=','enable')->first();
        foreach($orders as $order)
        {
            $clientsAtr =ClientAttribution::where('existing_client_id',$order->client_id)->with('previousClient')->first();

            if(!empty($clientsAtrs))
            {
                $order['cleintsAtrrs'] = $clientsAtr->previousClient ;
                $marketing == null ? $marketing->level1 = 0 : $marketing->level1 = intval($marketing->level1);

            }else
            {
                $order['cleintsAtrrs'] = null;
                $marketing->level1 = 0;
            }

            $market = $order->cvalue * ($marketing->level1/100);
            $Value = $order->fvalue + $market ;
            $finalValue = $order->cvalue - $Value ;
        }
        return ['orders' => $orders ,'marketing' => $marketing ,'fainlValue' => $finalValue, 'inventories' => $inventories['inventories']];

    }
    public function marketingDetailsView($language,$id)
    {
        $mar = $this->marketingDetails($id);
        $orders = $mar['orders'];
        $marketing = $mar['marketing'];
        $title = 'عمولة المسوقين بالعمولة';
        $description = 'عمولة المسوقين بالعمولة';

        return view('reports.details.marketing',compact('orders','marketing','title','description'));

    }
    public function SalesAgentAndSalesOffier($id)
    {
        $mar = $this->marketingDetails($id);
        $orders = $mar['orders'];
        // dd($orders);
        $sales_team = SalesTeam::where('new_franchise_id',$mar['inventories']->new_franchise_id)->first();
        foreach($orders as $order)
        {
            // dd($order);
            $mar['marketing']->level1 == 0 ? $market = 0 : $market = $order->cvalue * ($mar['marketing']->level1/100) ;

            $Value = (intval($order->fvalue) + $market) ;
            // dd($Value);
            $finalValue = $order->cvalue - $Value ;
            $order['finalValue'] = $finalValue ;

            $order['salesAgent'] = User::where('id',$order->client->user_id)->first();
            $salesOfficerValue = ($finalValue* ($sales_team->sales_officer/100)) + $sales_team->sales_officer_salary;

            $saleAgentValue = ($finalValue * ($sales_team->sales_agent/100)) + $sales_team->sales_agent_salary;

            $order['finalValueOFSalesAgent'] = $finalValue - ($salesOfficerValue + $saleAgentValue);

            $order['salesOfficer'] = User::where('id',$order['salesAgent']->manager_id)->first();

        }
        // dd($orders);
        return ['orders'=>$orders ,'sales_team' => $sales_team ];
    }
    public function SalesAgentView($language,$id)
    {
        $sales = $this->SalesAgentAndSalesOffier($id);
        // dd($sales);
        $orders = $sales['orders'];
        $sales_team = $sales['sales_team'];
        $title = 'عمولة وكيل المبيعات';
        $description = 'عمولة وكيل المبيعات';

        return view('reports.details.salesAgent',compact('orders','sales_team','title','description'));
    }
    public function SalesOffierView($language , $id)
    {
        // dd($id);
        $sales = $this->SalesAgentAndSalesOffier($id);
        $orders = $sales['orders'];
        $sales_team = $sales['sales_team'];
        $title = 'عمولة مسؤول المبيعات';
        $description = 'عمولة مسؤول المبيعات';
        return view('reports.details.salesOfficer',compact('orders','sales_team','title','description'));

    }

    public function settingDetailsView($langauge,$id)
    {
        $sales = $this->SalesAgentAndSalesOffier($id);
        $orders = $sales['orders'];
        $settings = Setting::whereIn('new_franchise_id',$orders->pluck('new_franchise_id'))->get();
//        dd($orders);
        // dd($settings);
        $title = 'اجمالي الميزانيات';
        $description = 'اجمالي الميزانيات';
        return view('reports.details.setting',compact('settings','orders','title','description'));
    }

}
