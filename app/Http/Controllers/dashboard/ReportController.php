<?php

namespace App\Http\Controllers\dashboard;

use App\Models\GeneralInventory;
use App\Models\InventoryUpdates;
use App\Models\ManagementTeam;
use App\Models\Marketing;
use App\Models\SalesTeam;
use App\Models\User;
use App\Models\Order;
use App\Models\Proof;
use App\Models\MainField;
use App\Models\Freelancer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientAttribution;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as FacadesLog;
use function PHPUnit\Framework\isEmpty;

class ReportController extends Controller
{


public function inventoryUpdates()
{
    $title = 'inventory updates';
    $description = 'inventory updates';
    $inventory = InventoryUpdates::all();
    return view('inventoryUpdates.all', compact('inventory','title','description'));
}
public function deleteInventoryUpdate($language ,$id)
{
//    dd($id);
    $inventory =InventoryUpdates::findOrFail($id);
    $inventory->delete();
    $notification = array(
        'message' => 'تم الحذف بنجاح',
        'alert-type' => 'success'
    );

    return redirect()->route('inventory.update' , app()->getLocale())->with($notification);

}
    // قيمة إجمالي مستحقات مستقلين الشركة في كل مجال

// public function generateReport()
// {
//     $newFranchiseId = Auth::user()->new_franchise_id;

//     // Get total fvalue for the franchise
//     $totalFvalue = Order::where('new_franchise_id', $newFranchiseId)
//         ->sum(DB::raw('CAST(fvalue AS DECIMAL(10,2))'));

//     // Get fvalue per main field
//     $fieldValues = Order::where('orders.new_franchise_id', $newFranchiseId)
//         ->join('main_fields', 'orders.main_field_id', '=', 'main_fields.id')
//         ->select('main_fields.title',
//                  DB::raw('SUM(CAST(orders.fvalue AS DECIMAL(10,2))) as field_fvalue'))
//         ->groupBy('main_fields.id', 'main_fields.title')
//         ->get();

//     // Calculate percentages
//     $reportData = $fieldValues->map(function ($item) use ($totalFvalue) {
//         $percentage = $totalFvalue > 0 ? ($item->field_fvalue / $totalFvalue) * 100 : 0;
//         return [
//             'field' => $item->title,
//             'fvalue' => $item->field_fvalue,
//             'percentage' => round($percentage, 2)
//         ];
//     });

//     return [
//         'total_fvalue' => $totalFvalue,
//         'field_breakdown' => $reportData
//     ];
// }



//  مستحقات لمدير الموارد البشرية

    public function report_human_manager(){

            $title = "human report";
            $description = "human report";

            $roleName = 'مسؤول الموارد البشرية'; // Replace with the actual role name

            $hrRes = User::where('role', $roleName)->first();


            if (!$hrRes) {
                die('HR Res not found');
            }

            // عاوز اجيب عدد المستقلين لكل مجال اللي ضافهم مسؤولي الموارد البشرية

            $freelancersCountByFieldRes = MainField::select('main_fields.title', \DB::raw('COUNT(freelancers.id) as freelancer_count'))
                ->leftJoin('freelancers', 'main_fields.id', '=', 'freelancers.main_field_id')
                ->leftJoin('users as hr', 'main_fields.user_id', '=', 'hr.id')
                ->where('hr.id', $hrRes->id)
                ->groupBy('main_fields.id', 'main_fields.title')
                ->get();



            $roleName = 'مدير الموارد البشرية'; // Replace with the actual role name

            $hrMan = User::where('role', $roleName)->first();

            if (!$hrMan) {
                die('HR Manager not found');
            }

            // عاوز اجيب عدد المستقلين لكل مجال اللي ضافهم مدير الموارد البشرية
            $freelancersCountByFieldMan = MainField::select('main_fields.title', \DB::raw('COUNT(freelancers.id) as freelancer_count'))
                ->leftJoin('freelancers', 'main_fields.id', '=', 'freelancers.main_field_id')
                ->leftJoin('users as hr', 'main_fields.user_id', '=', 'hr.id')
                ->where('hr.id', $hrMan->id)
                ->groupBy('main_fields.id', 'main_fields.title')
                ->get();


            // مستحقات المدير

            $freelancersRes = DB::table('freelancers')
            ->join('users', 'freelancers.user_id', '=', 'users.id')
            ->where('users.role', 'مسؤول الموارد البشرية')
            ->select('freelancers.*')
            ->count();

            // dd($freelancersRes);


            $freelancersMan = DB::table('freelancers')
            ->join('users', 'freelancers.user_id', '=', 'users.id')
            ->where('users.role', 'مدير الموارد البشرية')
            ->select('freelancers.*')
            ->count();

            // dd($freelancersMan);


            $result = ($freelancersRes * 0.30) + ($freelancersMan * 1);

            $manager = User::where('role', 'مدير الموارد البشرية')->value('id');

        return view('reports.human_manager' , compact("freelancersCountByFieldRes" , "freelancersCountByFieldMan" , "result" , "manager" ,"title" , "description"));
    }



//  مستحقات لمسؤول الموارد البشرية

    public function report_human_res(){

            $title = "res report";
            $description = "res report";

            // عاوز اجيب عدد المستقلين لكل مجال اللي ضافهم مسؤولي الموارد البشرية
            $roleName = 'مسؤول الموارد البشرية'; // Replace with the actual role name

            $hrRes = User::where('role', $roleName)->first();


            if (!$hrRes) {
                die('HR Res not found');
            }

            // عاوز اجيب عدد المستقلين لكل مجال اللي ضافهم مسؤولي الموارد البشرية

            $freelancersCountByFieldRes = MainField::select('main_fields.title', \DB::raw('COUNT(freelancers.id) as freelancer_count'))
                ->leftJoin('freelancers', 'main_fields.id', '=', 'freelancers.main_field_id')
                ->leftJoin('users as hr', 'main_fields.user_id', '=', 'hr.id')
                ->where('hr.id', $hrRes->id)
                ->groupBy('main_fields.id', 'main_fields.title')
                ->get();



            // مستحقات المدير

            $freelancersRes = DB::table('freelancers')
            ->join('users', 'freelancers.user_id', '=', 'users.id')
            ->where('users.role', 'مسؤول الموارد البشرية')
            ->select('freelancers.*')
            ->count();


            $result = ($freelancersRes * 0.70);

            $manager = User::where('role', 'مسؤول الموارد البشرية')->value('id');


           return view('reports.res_manager' , compact("freelancersCountByFieldRes"  , "result" , "manager" ,"title" , "description"));


    }



    public function store_proof(Request $request){


        $data = $request->validate([
            "link" => 'required'
        ]);

        $manager = User::where('role', 'مدير الموارد البشرية')->value('id');

        Proof::create([
            'link' => $data['link'],
            'user_id' => $manager,
        ]);

        return redirect()->route('report_human_manager' , app()->getLocale());

    }

    public function store_proof_res(Request $request){


        $data = $request->validate([
            "link" => 'required'
        ]);

        $manager = User::where('role', 'مسؤول الموارد البشرية')->value('id');

        Proof::create([
            'link' => $data['link'],
            'user_id' => $manager,
        ]);

        return redirect()->route('report_res_manager' , app()->getLocale());

    }



// عدد الطلبات
public function orderChartData()
{
    $franchiseId = Auth::user()->new_franchise_id;

    // Fetch total orders per main field for the specific franchise
    $orders = DB::table('orders')
        ->select('main_field_id', DB::raw('count(*) as total_orders'))
        ->where('new_franchise_id', $franchiseId)
        ->where('status' ,'مسلم')
        ->groupBy('main_field_id')
        ->get();

    // Get all main fields
    $mainFields = MainField::all();

    // Create a map of main_field_id to title
    $mainFieldsMap = $mainFields->pluck('title', 'id')->all();

    // Calculate the total number of orders
    $totalOrders = $orders->sum('total_orders');

    // Prepare the order data
    $orderData = $orders->map(function($order) use ($totalOrders, $mainFieldsMap) {
        return [
            'main_field_id' => $order->main_field_id,
            'main_field_title' => $mainFieldsMap[$order->main_field_id] ?? 'Unknown',
            'total_orders' => $order->total_orders,
            'percentage' => round(($order->total_orders / $totalOrders) * 100, 2)
        ];
    });

    // Prepare data for the chart
    $chartData = [
        'labels' => $orderData->pluck('main_field_title'),
        'datasets' => [
            [
                'data' => $orderData->pluck('total_orders'),
                'backgroundColor' => [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40',
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                ],
            ]
        ]
    ];

    $title = "إجمالي عدد طلبات";
    $description = "عدد الطلبات في كل مجال";

    return view('reports.order_chart', compact('chartData', 'title', 'description', 'orderData'));
}



// إجمالي الإيرادات

public function revenueChartData()
{
    $franchiseId = Auth::user()->new_franchise_id;

    $revenues = DB::table('orders')
        ->join('main_fields', 'orders.main_field_id', '=', 'main_fields.id')
        ->select('main_fields.id', 'main_fields.title', DB::raw('SUM(orders.cvalue) as total_revenue'))
        ->where('orders.new_franchise_id', $franchiseId)
        ->where('status' ,'مسلم')
        ->groupBy('main_fields.id', 'main_fields.title')
        ->get();

    $totalRevenue = $revenues->sum('total_revenue');

    $chartData = $revenues->map(function ($revenue) use ($totalRevenue) {
        $percentage = $totalRevenue > 0 ? ($revenue->total_revenue / $totalRevenue) * 100 : 0;
        return [
            'label' => $revenue->title,
            'value' => round($revenue->total_revenue, 2),
            'percentage' => round($percentage, 2)
        ];
    });

        $title = "revenue chart";
    $description = "revenue chart";

    return view('reports.revenue_chart', [
        'totalRevenue' => round($totalRevenue, 2),
        'chartData' => $chartData,
        'title' => $title,
        'description' => $description,
    ]);
}


// مستحقات المستقلين

public function duesChartData(){

        $franchiseId = Auth::user()->new_franchise_id;

        $totalEarnings = Order::where('orders.new_franchise_id', $franchiseId)
            ->where('status' ,'مسلم')
            ->sum(DB::raw('CAST(fvalue AS DECIMAL(10,2))'));

        $fieldEarnings = Order::where('orders.new_franchise_id', $franchiseId)
            ->join('main_fields', 'orders.main_field_id', '=', 'main_fields.id')
            ->select('main_fields.title', DB::raw('SUM(CAST(orders.fvalue AS DECIMAL(10,2))) as total'))
            ->groupBy('main_fields.id', 'main_fields.title')
            ->get();

        $labels = $fieldEarnings->pluck('title');
        $data = $fieldEarnings->pluck('total');

        $title = "revenue chart";
    $description = "revenue chart";


        return view('reports.total_freelancers_dues', compact('totalEarnings', 'labels', 'data' , 'title' , 'description'));

}


// مستحقات للوكلاء
    public function revenueAndDuesChartData()
{
    $franchiseId = Auth::user()->new_franchise_id;

    $orders = Order::where('new_franchise_id', $franchiseId)
        ->where('status' ,'مسلم')
        ->with(['user']) // Eager load the user relationship
        ->get();

    $agentEarnings = [];
    $totalEarnings = 0;

    foreach ($orders as $order) {
        $profit = $order->cvalue - $order->fvalue;
        $agentShare = $profit * 0.2; // 20% of profit

        $fieldId = $order->main_field_id;
        $fieldName = $order->mainField->title; // Assuming the field has a 'name' attribute

        if (!isset($fieldEarnings[$fieldId])) {
            $fieldEarnings[$fieldId] = [
                'name' => $fieldName,
                'earnings' => 0
            ];
        }

        $fieldEarnings[$fieldId]['earnings'] += $agentShare;
        $totalEarnings += $agentShare;
    }

    $chartData = [];
    foreach ($fieldEarnings as $fieldId => $data) {
        $percentage = ($data['earnings'] / $totalEarnings) * 100;
        $chartData[] = [
            'label' => $data['name'],
            'value' => round($data['earnings'], 2),
            'percentage' => round($percentage, 2)
        ];
    }


                $title = "agents report";
            $description = "agents report";


    return view('reports.agent_reports', [
        'totalEarnings' => round($totalEarnings, 2),
        'chartData' => $chartData,
        'title' => $title,
        'description' => $description,
    ]);
}


// مستحقات مسؤول المبيعات
public function salesCommissionChart(){
   $franchiseId = Auth::user()->new_franchise_id;

$orders = Order::where('new_franchise_id', $franchiseId)
    ->where('status' ,'مسلم')
    ->with(['user', 'mainField']) // Eager load both user and mainField relationships
    ->get();

$managerEarnings = [];
$totalEarnings = 0;

foreach ($orders as $order) {
    $profit = $order->cvalue - $order->fvalue;
    $managerShare = $profit * 0.1; // 10% of profit

    $fieldId = $order->main_field_id;
    $fieldName = $order->mainField->title; // Using 'title' instead of 'name'

    if (!isset($managerEarnings[$fieldId])) {
        $managerEarnings[$fieldId] = [
            'name' => $fieldName,
            'earnings' => 0
        ];
    }

    $managerEarnings[$fieldId]['earnings'] += $managerShare;
    $totalEarnings += $managerShare;
}

$chartData = [];
foreach ($managerEarnings as $fieldId => $data) {
    $percentage = ($data['earnings'] / $totalEarnings) * 100;
    $chartData[] = [
        'label' => $data['name'],
        'value' => round($data['earnings'], 2),
        'percentage' => round($percentage, 2)
    ];
}

        $title = "sales report";
        $description = "sales report";

    return view('reports.sales_commission', [
        'totalEarnings' => round($totalEarnings, 2),
        'chartData' => $chartData,
        'title' => $title,
        'description' => $description
    ]);

}



//مستحقات المسوقين بالعمولة

public function affiliateMarketers()
{
    $franchiseId = Auth::user()->new_franchise_id;
    $attributions = ClientAttribution::where('new_franchise_id', $franchiseId)
        ->with(['previousClient', 'existingClient', 'existingClient.orders'])
        ->get();

    $commissionData = [];
    $totalCommissionSum = 0;

    foreach ($attributions as $attribution) {
        $existingClientOrders = $attribution->existingClient->orders()
            ->where('new_franchise_id', $franchiseId)
            ->get();

        $totalCommission = 0;
        $orderCount = 0;
        $orderValues = [];
        $commissions = [];

        foreach ($existingClientOrders as $order) {
            $commission = $order->cvalue * 0.1; // 10% of cvalue
            $totalCommission += $commission;
            $orderCount++;
            $orderValues[] = $order->id; // Assuming you want order IDs or any other order attribute
            $commissions[] = $commission;
        }

        if ($totalCommission > 0) {
            $commissionData[] = [
                'name' => $attribution->previousClient->name,
                'commission' => $totalCommission,
                'orderCount' => $orderCount,
                'existingClientName' => $attribution->existingClient->name,
                'orders' => $orderValues,
                'commissions' => $commissions
            ];
            $totalCommissionSum += $totalCommission;
        }
    }

    // Sort by commission in descending order
    usort($commissionData, function($a, $b) {
        return $b['commission'] <=> $a['commission'];
    });

    $labels = array_column($commissionData, 'name');
    $data = array_column($commissionData, 'commission');

    $title = "المسوقون بالعمولة";
    $description = "تقرير مفصل عن المسوقين بالعمولة وأرباحهم";

    return view('reports.affiliate_marketers', compact('labels', 'data', 'title', 'description', 'commissionData', 'totalCommissionSum'));
}



// مستحقات مدير المبيعات
public function combinedReport()
{
    $franchiseId = Auth::user()->new_franchise_id;

    // Get all orders for this franchise
    $orders = Order::where('new_franchise_id', $franchiseId)
        ->where('status' ,'مسلم')
        ->with(['mainField'])
        ->get();

    $fieldData = [];
    $totalRevenue = 0;
    $totalFreelancerDues = 0;
    $totalAffiliateMarketersCommission = 0;
    $totalAgentAndSalesManagerCommission = 0;

    foreach ($orders as $order) {
        $fieldId = $order->main_field_id;
        $fieldName = $order->mainField->title;

        if (!isset($fieldData[$fieldId])) {
            $fieldData[$fieldId] = [
                'name' => $fieldName,
                'revenue' => 0,
                'freelancerDues' => 0,
                'profit' => 0,
            ];
        }

        // Revenue (cvalue)
        $fieldData[$fieldId]['revenue'] += $order->cvalue;
        $totalRevenue += $order->cvalue;

        // Freelancer dues (fvalue)
        $fieldData[$fieldId]['freelancerDues'] += $order->fvalue;
        $totalFreelancerDues += $order->fvalue;

        // Affiliate Marketers Commission (10% of cvalue)
        $affiliateCommission = $order->cvalue * 0.1;
        $totalAffiliateMarketersCommission += $affiliateCommission;

        // Agent and Sales Manager Commission (30% of profit)
        $profit = $order->cvalue - $order->fvalue;
        $agentAndSalesManagerCommission = $profit * 0.3;
        $totalAgentAndSalesManagerCommission += $agentAndSalesManagerCommission;

        // Calculate profit for each field
        $fieldData[$fieldId]['profit'] += $profit - $affiliateCommission - $agentAndSalesManagerCommission;
    }

    // Calculate total profit
    $totalProfit = $totalRevenue - ($totalFreelancerDues + $totalAffiliateMarketersCommission + $totalAgentAndSalesManagerCommission);

    // Calculate sales manager dues (5% of total profit)
    $salesManagerDues = $totalProfit * 0.05;

    // Prepare chart data
    $chartData = [];
    foreach ($fieldData as $fieldId => $data) {
        $fieldProfit = $data['profit'];
        $fieldSalesManagerDues = $fieldProfit * 0.05;
        $percentage = ($fieldSalesManagerDues / $salesManagerDues) * 100;

        $chartData[] = [
            'label' => $data['name'],
            'value' => round($fieldSalesManagerDues, 2),
            'percentage' => round($percentage, 2)
        ];
    }

    $title = "تقرير مستحقات مدير المبيعات";
    $description = "توزيع مستحقات مدير المبيعات حسب المجال";

    return view('reports.sales_manager', [
        'totalSalesManagerDues' => round($salesManagerDues, 2),
        'chartData' => $chartData,
        'title' => $title,
        'description' => $description,
    ]);
}



//مستحقات المدير التقني

public function technical_director()
{
    $franchiseId = Auth::user()->new_franchise_id;

    // Get all orders for this franchise
    $orders = Order::where('new_franchise_id', $franchiseId)
        ->where('status' ,'مسلم')
        ->with(['mainField'])
        ->get();

    $fieldData = [];
    $totalRevenue = 0;
    $totalFreelancerDues = 0;
    $totalAffiliateMarketersCommission = 0;
    $totalAgentAndSalesManagerCommission = 0;

    foreach ($orders as $order) {
        $fieldId = $order->main_field_id;
        $fieldName = $order->mainField->title;

        if (!isset($fieldData[$fieldId])) {
            $fieldData[$fieldId] = [
                'name' => $fieldName,
                'revenue' => 0,
                'freelancerDues' => 0,
                'profit' => 0,
            ];
        }

        // Revenue (cvalue)
        $fieldData[$fieldId]['revenue'] += $order->cvalue;
        $totalRevenue += $order->cvalue;

        // Freelancer dues (fvalue)
        $fieldData[$fieldId]['freelancerDues'] += $order->fvalue;
        $totalFreelancerDues += $order->fvalue;

        // Affiliate Marketers Commission (10% of cvalue)
        $affiliateCommission = $order->cvalue * 0.1;
        $totalAffiliateMarketersCommission += $affiliateCommission;

        // Agent and Sales Manager Commission (30% of profit)
        $profit = $order->cvalue - $order->fvalue;
        $agentAndSalesManagerCommission = $profit * 0.3;
        $totalAgentAndSalesManagerCommission += $agentAndSalesManagerCommission;

        // Calculate profit for each field
        $fieldData[$fieldId]['profit'] += $profit - $affiliateCommission - $agentAndSalesManagerCommission;
    }

    // Calculate total profit
    $totalProfit = $totalRevenue - ($totalFreelancerDues + $totalAffiliateMarketersCommission + $totalAgentAndSalesManagerCommission);

    // Calculate sales manager dues (5% of total profit)
    $salesManagerDues = $totalProfit * 0.05;

    // Prepare chart data
    $chartData = [];
    foreach ($fieldData as $fieldId => $data) {
        $fieldProfit = $data['profit'];
        $fieldSalesManagerDues = $fieldProfit * 0.05;
        $percentage = ($fieldSalesManagerDues / $salesManagerDues) * 100;

        $chartData[] = [
            'label' => $data['name'],
            'value' => round($fieldSalesManagerDues, 2),
            'percentage' => round($percentage, 2)
        ];
    }

    $title = "تقرير مستحقات المدير التقني ";
    $description = "توزيع مستحقات  المدير التقني حسب المجال";

    return view('reports.technical_director', [
        'totalSalesManagerDues' => round($salesManagerDues, 2),
        'chartData' => $chartData,
        'title' => $title,
        'description' => $description,
    ]);
}



// مستحقات المدير المالي

public function financial_officer()
{
    $franchiseId = Auth::user()->new_franchise_id;

    // Get all orders for this franchise
    $orders = Order::where('new_franchise_id', $franchiseId)
        ->where('status' ,'مسلم')
        ->with(['mainField'])
        ->get();

    $fieldData = [];
    $totalRevenue = 0;
    $totalFreelancerDues = 0;
    $totalAffiliateMarketersCommission = 0;
    $totalAgentAndSalesManagerCommission = 0;

    foreach ($orders as $order) {
        $fieldId = $order->main_field_id;
        $fieldName = $order->mainField->title;

        if (!isset($fieldData[$fieldId])) {
            $fieldData[$fieldId] = [
                'name' => $fieldName,
                'revenue' => 0,
                'freelancerDues' => 0,
                'profit' => 0,
            ];
        }

        // Revenue (cvalue)
        $fieldData[$fieldId]['revenue'] += $order->cvalue;
        $totalRevenue += $order->cvalue;

        // Freelancer dues (fvalue)
        $fieldData[$fieldId]['freelancerDues'] += $order->fvalue;
        $totalFreelancerDues += $order->fvalue;

        // Affiliate Marketers Commission (10% of cvalue)
        $affiliateCommission = $order->cvalue * 0.1;
        $totalAffiliateMarketersCommission += $affiliateCommission;

        // Agent and Sales Manager Commission (30% of profit)
        $profit = $order->cvalue - $order->fvalue;
        $agentAndSalesManagerCommission = $profit * 0.3;
        $totalAgentAndSalesManagerCommission += $agentAndSalesManagerCommission;

        // Calculate profit for each field
        $fieldData[$fieldId]['profit'] += $profit - $affiliateCommission - $agentAndSalesManagerCommission;
    }

    // Calculate total profit
    $totalProfit = $totalRevenue - ($totalFreelancerDues + $totalAffiliateMarketersCommission + $totalAgentAndSalesManagerCommission);

    // Calculate sales manager dues (5% of total profit)
    $salesManagerDues = $totalProfit * 0.05;

    // Prepare chart data
    $chartData = [];
    foreach ($fieldData as $fieldId => $data) {
        $fieldProfit = $data['profit'];
        $fieldSalesManagerDues = $fieldProfit * 0.05;
        $percentage = ($fieldSalesManagerDues / $salesManagerDues) * 100;

        $chartData[] = [
            'label' => $data['name'],
            'value' => round($fieldSalesManagerDues, 2),
            'percentage' => round($percentage, 2)
        ];
    }

    $title = "تقرير مستحقات المدير المالي ";
    $description = "توزيع مستحقات  المدير المالي حسب المجال";

    return view('reports.financial_officer', [
        'totalSalesManagerDues' => round($salesManagerDues, 2),
        'chartData' => $chartData,
        'title' => $title,
        'description' => $description,
    ]);
}




// مستحقات المدير التنفيذي

public function ceo_remuneration()
{
    $franchiseId = Auth::user()->new_franchise_id;

    // Get all orders for this franchise
    $orders = Order::where('new_franchise_id', $franchiseId)
        ->where('status' ,'مسلم')
        ->with(['mainField'])
        ->get();

    $fieldData = [];
    $totalRevenue = 0;
    $totalFreelancerDues = 0;
    $totalAffiliateMarketersCommission = 0;
    $totalAgentAndSalesManagerCommission = 0;

    foreach ($orders as $order) {
        $fieldId = $order->main_field_id;
        $fieldName = $order->mainField->title;

        if (!isset($fieldData[$fieldId])) {
            $fieldData[$fieldId] = [
                'name' => $fieldName,
                'revenue' => 0,
                'freelancerDues' => 0,
                'profit' => 0,
            ];
        }

        // Revenue (cvalue)
        $fieldData[$fieldId]['revenue'] += $order->cvalue;
        $totalRevenue += $order->cvalue;

        // Freelancer dues (fvalue)
        $fieldData[$fieldId]['freelancerDues'] += $order->fvalue;
        $totalFreelancerDues += $order->fvalue;

        // Affiliate Marketers Commission (10% of cvalue)
        $affiliateCommission = $order->cvalue * 0.1;
        $totalAffiliateMarketersCommission += $affiliateCommission;

        // Agent and Sales Manager Commission (30% of profit)
        $profit = $order->cvalue - $order->fvalue;
        $agentAndSalesManagerCommission = $profit * 0.3;
        $totalAgentAndSalesManagerCommission += $agentAndSalesManagerCommission;

        // Calculate profit for each field
        $fieldData[$fieldId]['profit'] += $profit - $affiliateCommission - $agentAndSalesManagerCommission;
    }

    // Calculate total profit
    $totalProfit = $totalRevenue - ($totalFreelancerDues + $totalAffiliateMarketersCommission + $totalAgentAndSalesManagerCommission);

    // Calculate CEO remuneration (10% of total profit)
    $ceoRemuneration = $totalProfit * 0.10;

    // Prepare chart data
    $chartData = [];
    foreach ($fieldData as $fieldId => $data) {
        $fieldProfit = $data['profit'];
        $fieldCeoRemuneration = $fieldProfit * 0.10;
        $percentage = ($fieldCeoRemuneration / $ceoRemuneration) * 100;

        $chartData[] = [
            'label' => $data['name'],
            'value' => round($fieldCeoRemuneration, 2),
            'percentage' => round($percentage, 2)
        ];
    }

    $title = "تقرير مستحقات المدير التنفيذي";
    $description = "توزيع مستحقات المدير التنفيذي حسب المجال";

    return view('reports.ceo_remuneration', [
        'totalSalesManagerDues' => round($ceoRemuneration, 2),
        'chartData' => $chartData,
        'title' => $title,
        'description' => $description,
    ]);
}


// ميزانية التسويق

public function calculateMarketingBudget()
{

 $franchiseId = Auth::user()->new_franchise_id;

    // Get all orders for this franchise
    $orders = Order::where('new_franchise_id', $franchiseId)
        ->where('status' ,'مسلم')
        ->with(['mainField'])
        ->get();

    $fieldData = [];
    $totalRevenue = 0;
    $totalFreelancerDues = 0;
    $totalAffiliateMarketersCommission = 0;
    $totalAgentAndSalesManagerCommission = 0;

    foreach ($orders as $order) {
        $fieldId = $order->main_field_id;
        $fieldName = $order->mainField->title;

        if (!isset($fieldData[$fieldId])) {
            $fieldData[$fieldId] = [
                'name' => $fieldName,
                'revenue' => 0,
                'freelancerDues' => 0,
                'profit' => 0,
            ];
        }

        // Revenue (cvalue)
        $fieldData[$fieldId]['revenue'] += $order->cvalue;
        $totalRevenue += $order->cvalue;

        // Freelancer dues (fvalue)
        $fieldData[$fieldId]['freelancerDues'] += $order->fvalue;
        $totalFreelancerDues += $order->fvalue;

        // Affiliate Marketers Commission (10% of cvalue)
        $affiliateCommission = $order->cvalue * 0.1;
        $totalAffiliateMarketersCommission += $affiliateCommission;

        // Agent and Sales Manager Commission (30% of profit)
        $profit = $order->cvalue - $order->fvalue;
        $agentAndSalesManagerCommission = $profit * 0.3;
        $totalAgentAndSalesManagerCommission += $agentAndSalesManagerCommission;

        // Calculate profit for each field
        $fieldData[$fieldId]['profit'] += $profit - $affiliateCommission - $agentAndSalesManagerCommission;
    }

    // Calculate total profit
    $totalProfit = $totalRevenue - ($totalFreelancerDues + $totalAffiliateMarketersCommission + $totalAgentAndSalesManagerCommission);

    // Calculate CEO remuneration (10% of total profit)
    $ceoRemuneration = $totalProfit * 0.10;

    // Prepare chart data
    $chartData = [];
    foreach ($fieldData as $fieldId => $data) {
        $fieldProfit = $data['profit'];
        $fieldCeoRemuneration = $fieldProfit * 0.10;
        $percentage = ($fieldCeoRemuneration / $ceoRemuneration) * 100;

        $chartData[] = [
            'label' => $data['name'],
            'value' => round($fieldCeoRemuneration, 2),
            'percentage' => round($percentage, 2)
        ];
    }


    $title = "تقرير ميزانية التسويق";
    $description = "توزيع ميزانية التسويق حسب المجال";

    return view('reports.marketing_budget_breakdown',[
        'totalSalesManagerDues' => round($ceoRemuneration, 2),
        'chartData' => $chartData,
        'title' => $title,
        'description' => $description,
    ]);
}


// ميزانية التطوير
public function calculateDeveloperBudget()
{


    $franchiseId = Auth::user()->new_franchise_id;

    // Get all orders for this franchise
    $orders = Order::where('new_franchise_id', $franchiseId)
        ->where('status' ,'مسلم')
        ->with(['mainField'])
        ->get();

    $fieldData = [];
    $totalRevenue = 0;
    $totalFreelancerDues = 0;
    $totalAffiliateMarketersCommission = 0;
    $totalAgentAndSalesManagerCommission = 0;

    foreach ($orders as $order) {
        $fieldId = $order->main_field_id;
        $fieldName = $order->mainField->title;

        if (!isset($fieldData[$fieldId])) {
            $fieldData[$fieldId] = [
                'name' => $fieldName,
                'revenue' => 0,
                'freelancerDues' => 0,
                'profit' => 0,
            ];
        }

        // Revenue (cvalue)
        $fieldData[$fieldId]['revenue'] += $order->cvalue;
        $totalRevenue += $order->cvalue;

        // Freelancer dues (fvalue)
        $fieldData[$fieldId]['freelancerDues'] += $order->fvalue;
        $totalFreelancerDues += $order->fvalue;

        // Affiliate Marketers Commission (10% of cvalue)
        $affiliateCommission = $order->cvalue * 0.1;
        $totalAffiliateMarketersCommission += $affiliateCommission;

        // Agent and Sales Manager Commission (30% of profit)
        $profit = $order->cvalue - $order->fvalue;
        $agentAndSalesManagerCommission = $profit * 0.3;
        $totalAgentAndSalesManagerCommission += $agentAndSalesManagerCommission;

        // Calculate profit for each field
        $fieldData[$fieldId]['profit'] += $profit - $affiliateCommission - $agentAndSalesManagerCommission;
    }

    // Calculate total profit
    $totalProfit = $totalRevenue - ($totalFreelancerDues + $totalAffiliateMarketersCommission + $totalAgentAndSalesManagerCommission);

    // Calculate sales manager dues (5% of total profit)
    $salesManagerDues = $totalProfit * 0.05;

    // Prepare chart data
    $chartData = [];
    foreach ($fieldData as $fieldId => $data) {
        $fieldProfit = $data['profit'];
        $fieldSalesManagerDues = $fieldProfit * 0.05;
        $percentage = ($fieldSalesManagerDues / $salesManagerDues) * 100;

        $chartData[] = [
            'label' => $data['name'],
            'value' => round($fieldSalesManagerDues, 2),
            'percentage' => round($percentage, 2)
        ];
    }


    $title = "تقرير ميزانية التطوير";
    $description = "توزيع ميزانية التطوير حسب المجال";

    return view('reports.developer_budget_breakdown', [
        'totalSalesManagerDues' => round($salesManagerDues, 2),
        'chartData' => $chartData,
        'title' => $title,
        'description' => $description,
    ]);
}


// ارباح الشركة


public function calculateNetProfit()
{
    $franchiseId = Auth::user()->new_franchise_id;

    // حساب إجمالي الإيرادات
    $totalRevenue = Order::where('new_franchise_id', $franchiseId)->where('status' ,'مسلم')->sum('cvalue');
    $general_inventory = GeneralInventory::where('totalRevenue' ,$totalRevenue)->latest()->first();
    // حساب المستحقات والميزانيات

    // إعداد البيانات للرسم البياني
    $chartData = [
        'labels' => ['الإيرادات', 'المصروفات', 'الأرباح الصافية'],
        'data' => [$general_inventory->totalRevenue, $general_inventory->totalExpenses, $general_inventory->netProfit]
    ];
    $totalExpenses =$general_inventory->freelancerDues + $general_inventory->affiliateMarketersCommission + $general_inventory->agentAndSalesManagerCommission +
                    $general_inventory->salesManagerDues + $general_inventory->technicalDirectorDues + $general_inventory->financialOfficerDues +
                    $general_inventory->ceoRemuneration + $general_inventory->marketingBudget + $general_inventory->developerBudget;
    $netProfit = $general_inventory->netProfit;
    $breakdownData = [
        'مستحقات المستقلين' => $general_inventory->totalFreelancerDues,
        'عمولة المسوقين بالعمولة' => $general_inventory->affiliateMarketersCommission,
        'عمولة الوكلاء ومدير المبيعات' => $general_inventory->agentAndSalesManagerCommission,
        'مستحقات مدير المبيعات' => $general_inventory->salesManagerDues,
        'مستحقات المدير التقني' => $general_inventory->technicalDirectorDues,
        'مستحقات المدير المالي' => $general_inventory->financialOfficerDues,
        'مكافأة المدير التنفيذي' => $general_inventory->ceoRemuneration,
        'ميزانية التسويق' => $general_inventory->marketingBudget,
        'ميزانية التطوير' => $general_inventory->developerBudget,
        'اجمالي الميزانيات' => $general_inventory->totalSetting,

    ];

    $title = "التقرير النهائي للشركة";
    $description = "اتقرير النهائي للشركة";

    return view('reports.net_profit_report', compact('chartData', 'breakdownData', 'netProfit', 'totalRevenue', 'totalExpenses' , 'title', 'description'));
}

// sttings

public function setting_view(){

    $title = "add budget";
    $description = "add budget";
    return view('reports.settings.create' , compact("title" , "description"));

}

public function store_setting(Request $request){
//    dd($request->all());

   $data = $request->validate([
        "title" => 'required',
        "cost" => 'required',
        'salary' => 'required'
//        "other_expenses" => 'required',
    ]);
//   dd($data);

        $currentUser = Auth::user();
    if ($currentUser && $currentUser->new_franchise_id) {
        $data['new_franchise_id'] = $currentUser->new_franchise_id;
    }
//    Setting::create($data);
//    $title  = $data['title'];
//    $cost  = $data['cost'];
//dd($cost);
//    dd($data['title']);
//    if(is_array($data['title'])){
        foreach ($data['title'] as $index => $value) {

//        dd($data['cost'][$index]);
//            $data['cost'] =intval( str_replace('%','',$data['cost'][$index]));

            $cost = intval( str_replace('%','',$data['cost'][$index]));
            $salary = $data['salary'][$index];

            Setting::create([
                'title' => $value,
                'cost' => $cost,
                'salary' => $salary,
                'new_franchise_id' => $data['new_franchise_id'],
            ]);

        }

//    }else
//    {
//        Setting::create([
//            'title' => $data['value'],
//            'cost' => $data['cost'],
//            'salary' => $data['salary'],
//            'new_franchise_id' => $data['new_franchise_id'],
//        ]);
//    }

    $notification = array(
        'message' => 'تمت الاضافة بنجاح',
        'alert-type' => 'success'
    );

    return redirect()->route('all_settings' , app()->getLocale())->with($notification);


}

public function all_settings(){
    $setting = Setting::get();
    if($setting->first() !== null)
    {
        $title = "all settings";
        $description = "all settings";
        return view('reports.settings.all' , compact("setting" , "title" , "description"));

    }else
    {
        $title = "add budget";
        $description = "add budget";
        return view('reports.settings.create' , compact("title" , "description"));
    }

}

public function edit_setting($language , $id){
    $setting = Setting::findOrFail($id);
    $title = "edit setting";
    $description = "edit setting";
    return view('reports.settings.edit' , compact("setting" , "title" , "description"));

}

public function update_setting(Request $request , $language , $id){

    $data = $request->validate([
        "title" => 'required',
        "cost" => 'required',
        'salary' => 'required'
    ]);
    $data['cost'] =intval( str_replace('%','',$data['cost']));

    $setting = Setting::findOrFail($id);

        $currentUser = Auth::user();
    if ($currentUser && $currentUser->new_franchise_id) {
        $data['new_franchise_id'] = $currentUser->new_franchise_id;
    }

    $setting->update($data);

    $notification = array(
        'message' => 'تم التعديل بنجاح',
        'alert-type' => 'success'
    );

    return redirect()->route('all_settings' , app()->getLocale())->with($notification);

}

public function delete_setting($language , $id){

    $setting = Setting::findOrFail($id);

    $setting->delete();

    $notification = array(
        'message' => 'تم الحذف بنجاح',
        'alert-type' => 'success'
    );

    return redirect()->route('all_settings' , app()->getLocale())->with($notification);

}

// end settings
































}
