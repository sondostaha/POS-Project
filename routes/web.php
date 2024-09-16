<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboard\ClientController;
use App\Http\Controllers\dashboard\FranchiseController;
use App\Http\Controllers\dashboard\FreelancerController;
use App\Http\Controllers\dashboard\MarketingController;
use App\Http\Controllers\dashboard\OperatingController;
use App\Http\Controllers\dashboard\OrderController;
use App\Http\Controllers\dashboard\ProfileController;
use App\Http\Controllers\dashboard\RatingController;
use App\Http\Controllers\dashboard\ReportController;
use App\Http\Controllers\dashboard\RoleController;
use App\Http\Controllers\dashboard\TransferController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\EducationalController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PaginationController;
use App\Http\Controllers\dashboard\ManagementTeamController;
use App\Http\Controllers\dashboard\SalesTeamController;
use App\Http\Controllers\dashboard\FinalReportController;

use App\Models\Freelancer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>'guest'],function(){
    Route::get('/',[AuthController::class,'login'])->name('login');
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::get('/forget-password',[AuthController::class,'forgetPassword'])->name('forget_password');
    Route::post('/authenticate',[AuthController::class,'authenticate'])->name('authenticate');
    Route::put('/signup',[AuthController::class,'signup'])->name('signup');
});

Route::post('/logout',[AuthController::class,'logout'])->name('logout')->middleware('auth');
Route::get('/lang/{lang}',[ LanguageController::class,'switchLang'])->name('switch_lang');
Route::get('/pagination-per-page/{per_page}',[ PaginationController::class,'set_pagination_per_page'])->name('pagination_per_page');



Route::group(['middleware'=>'auth'],function(){
    Route::group(['prefix'=>'{language}'],function(){
        // المستقلين
            Route::get('freelancer' , [FreelancerController::class , 'add'])->name('add_freelancer');
            Route::get('freelancers' , [FreelancerController::class , 'all'])->name('get_freelancer');
            Route::post('freelancers' , [FreelancerController::class , 'store_freelancer'])->name('store_freelancer');
            Route::get('/editFreelancer/{id}' , [FreelancerController::class , 'edit_freelancer'])->name('edit_freelancer');
            Route::post('/updateFreelancer/{id}' , [FreelancerController::class , 'update_freelancer'])->name('update_freelancer');
            Route::get('/deleteFreelancer/{id}' , [FreelancerController::class , 'delete_freelancer'])->name('delete_freelancer');
            Route::get('/delete/all' , [FreelancerController::class , 'delete_all_freelancers'])->name('delete_all_freelancers');
            Route::post('/import_freelancers' , [FreelancerController::class , 'saveFreelancers'])->name('saveFreelancers');
            Route::get('/export_freelancers' , [FreelancerController::class , 'exportFreelancer'])->name('exportFreelancers');
            Route::get('/request/freelancer' , [FreelancerController::class , 'request_freelancer'])->name('request_freelancer');
            Route::post('/request/freelancer' , [FreelancerController::class , 'store_request_freelancer'])->name('store_request_freelancer');
            Route::get('/requests/freelancer' , [FreelancerController::class , 'get_request_freelancer'])->name('get_request_freelancer');
            Route::get('/edit/request/{id}' , [FreelancerController::class , 'edit_request_freelancer'])->name('edit_request_freelancer');
            Route::post('/update/request/{id}' , [FreelancerController::class , 'update_request_freelancer'])->name('update_request_freelancer');
            Route::get('/delete/request/{id}' , [FreelancerController::class , 'delete_request_freelancer'])->name('delete_request_freelancer');
            Route::post('/filter/freelancers' , [FreelancerController::class , 'filter'])->name('filter_free');
            Route::get('/freelancer/{id}' , [FreelancerController::class , 'show'])->name('show_freelancer');
            Route::get('/holiday/freelancer/{id}' , [FreelancerController::class , 'holiday'])->name('holiday');
            Route::get('/holiday/return/{id}' , [FreelancerController::class , 'return_holiday'])->name('return_holiday');
            Route::get('/freelance_status/{id}',[FreelancerController::class,'freelance_status'])->name('freelance_status');
            // تقييم المستقلين

            Route::get('rate/freelancer' , [RatingController::class , 'add_rating'])->name('add_rating');
            Route::get('ratings' , [RatingController::class , 'all_rating'])->name('all_rating');
            Route::post('ratings' , [RatingController::class , 'store_rating'])->name('store_rating');
            Route::get('edit/rating/{id}' , [RatingController::class , 'edit_rating'])->name('edit_rating');
            Route::post('update/rating/{id}' , [RatingController::class , 'update_rating'])->name('update_rating');
            Route::get('delete/rating/{id}' , [RatingController::class , 'delete_rating'])->name('delete_rating');




            // مجالات العمل
            Route::get('add/main/fields' , [FreelancerController::class , 'add_field'])->name('add_fields');
            Route::get('all/mainfields' , [FreelancerController::class , 'all_field'])->name('all_fields');
            Route::post('mainfields' , [FreelancerController::class , 'store_field'])->name('store_fields');
            Route::get('edit/main/field/{id}' , [FreelancerController::class , 'edit_field'])->name('edit_fields');
            Route::post('update/mainfield/{id}' , [FreelancerController::class , 'update_field'])->name('update_field');
            Route::get('delete/mainfield/{id}' , [FreelancerController::class , 'delete_field'])->name('delete_fields');


            Route::get('add/sub/fields' , [FreelancerController::class , 'add_sub_field'])->name('add_sub_fields');
            Route::get('all/subfields' , [FreelancerController::class , 'all_sub_field'])->name('all_sub_fields');
            Route::post('subfields' , [FreelancerController::class , 'store_sub_field'])->name('store_sub_fields');
            Route::get('edit/field/{id}' , [FreelancerController::class , 'edit_sub_field'])->name('edit_sub_fields');
            Route::post('update/field/{id}' , [FreelancerController::class , 'update_sub_field'])->name('update_sub_field');
            Route::get('delete/field/{id}' , [FreelancerController::class , 'delete_sub_field'])->name('delete_sub_fields');

            // العملاء

            Route::get('add/client' , [ClientController::class , 'add'])->name('add_clients');
            Route::get('all/clients' , [ClientController::class , 'all'])->name('all_clients');
            Route::post('store/clients' , [ClientController::class , 'store'])->name('store_clients');
            Route::get('edit/client/{id}' , [ClientController::class , 'edit'])->name('edit_client');
            Route::post('update/client/{id}' , [ClientController::class , 'update'])->name('update_clients');
            Route::get('delete/client/{id}' , [ClientController::class , 'delete'])->name('delete_client');

            Route::get('transfers/create', [ClientController::class, 'create_transfer'])->name('transfers.create');

            Route::get('transfers', [ClientController::class, 'transfer_index'])->name('transfers.index');


            Route::post('transfers', [ClientController::class, 'store_transfer'])->name('transfers.store');


            Route::get('transfers/download/{id}', [ClientController::class, 'download'])->name('transfers.download');



            // الفرانشيز
            Route::get('add/franshise/plan' , [FranchiseController::class , 'add'])->name('franchise_plan');
            Route::get('all/plans' , [FranchiseController::class , 'all_plans'])->name('all_franchise_plan');
            Route::post('plans' , [FranchiseController::class , 'store_plan'])->name('store_franchise_plan');
            Route::get('edit/plan/{id}' , [FranchiseController::class , 'edit_plan'])->name('edit_franchise_plan');
            Route::post('update/plan/{id}' , [FranchiseController::class , 'update_plan'])->name('update_franchise_plan');
            Route::get('delete/plan/{id}' , [FranchiseController::class , 'delete_plan'])->name('delete_franchise_plan');

            Route::get('add/new/franshise' , [FranchiseController::class , 'add_new'])->name('add_new_franchise');
            Route::get('all/new/franshise' , [FranchiseController::class , 'all_new'])->name('all_new_franchise');
            Route::post('store/new/franshise' , [FranchiseController::class , 'store_new'])->name('store_new_franchise');
            Route::get('edit/new/franchise/{id}' , [FranchiseController::class , 'edit_new'])->name('edit_new_franchise');
            Route::post('update/new/franchise/{id}' , [FranchiseController::class , 'update_new'])->name('update_new_franchise');
            Route::get('delete/new/franchise/{id}' , [FranchiseController::class , 'delete_new'])->name('delete_new_franchise');


            // Route::get('newfranshise' , [FranchiseController::class , 'add_new_franchise'])->name('new_franchise');


            // المستخدمين
            Route::get('add/user' , [UserController::class , 'add'])->name('add_user');
            Route::post('store/user' , [UserController::class , 'store'])->name('store_user');
            Route::get('all/users' , [UserController::class , 'all'])->name('get_user');
            Route::get('edit/users/{id}' , [UserController::class , 'edit_users'])->name('edit_user');
            Route::post('update/users/{id}' , [UserController::class , 'update_users'])->name('update_users');
            Route::get('delete/users/{id}' , [UserController::class , 'delete_users'])->name('delete_users');

            Route::post('edit/email/{id}' , [ProfileController::class , 'edit_email'])->name('edit_email');
            Route::post('edit/about/{id}' , [ProfileController::class , 'edit_about'])->name('edit_about');
            Route::post('edit/phone/{id}' , [ProfileController::class , 'edit_phone'])->name('edit_phone');
            Route::post('edit/vcash/{id}' , [ProfileController::class , 'edit_vcash'])->name('edit_vcash');
            Route::post('edit/egypost/{id}' , [ProfileController::class , 'edit_egypost'])->name('edit_egypost');
            Route::post('edit/card/{id}' , [ProfileController::class , 'edit_card'])->name('edit_card');
            Route::post('edit/facebook/{id}' , [ProfileController::class , 'edit_facebook'])->name('edit_facebook');
            Route::post('edit/wphone/{id}' , [ProfileController::class , 'edit_wphone'])->name('edit_wphone');
            Route::post('edit/name/{id}' , [ProfileController::class , 'edit_name'])->name('edit_name');
            Route::post('edit/password/{id}' , [ProfileController::class , 'edit_password'])->name('edit_password');




            // الصلاحيات
            // Route::get('add/permission' , [RoleController::class , 'add'])->name('add_permission');
            // Route::get('permissions' , [RoleController::class , 'all'])->name('all_permissions');
            // Route::post('permissions' , [RoleController::class , 'store'])->name('store_permissions');
            // Route::get('edit/permissions/{id}' , [RoleController::class , 'edit'])->name('edit_permissions');
            // Route::post('permissions/{id}' , [RoleController::class , 'update'])->name('update_permissions');
            // Route::get('delete/permission/{id}' , [RoleController::class , 'delete'])->name('delete_permissions');

            // الرتب
            // Route::get('add/role' , [RoleController::class , 'add_role'])->name('add_role');
            // Route::get('roles' , [RoleController::class , 'all_roles'])->name('all_roles');
            // Route::post('roles' , [RoleController::class , 'store_roles'])->name('store_roles');
            // Route::get('edit/role/{id}' , [RoleController::class , 'edit_role'])->name('edit_role');
            // Route::post('role/{id}' , [RoleController::class , 'update_role'])->name('update_role');
            // Route::get('delete/role/{id}' , [RoleController::class , 'delete_role'])->name('delete_role');


            Route::get('/roles' , [RoleController::class , 'index'])->name('roles.index');

            Route::get('all/roles' , [RoleController::class , 'all'])->name('roles.all');


            Route::post('/roles' , [RoleController::class , 'store'])->name('roles.store');


Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('roles/{id}', [RoleController::class, 'update'])->name('roles.update');

Route::get('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');






            // Route::get('roles/permissions' , [RoleController::class , 'add_permission_to_role'])->name('add_permission_to_roles');
            // Route::post('roles/permissions' , [RoleController::class , 'store_permission_to_role'])->name('store_permission_to_role');
            // Route::get('all/roles/permissions' , [RoleController::class , 'all_permission_to_role'])->name('all_roles_permissions');
            // Route::get('edit/roles/permissions/{id}' , [RoleController::class , 'edit_permission_to_role'])->name('edit_roles_permissions');
            // Route::post('update/roles/permissions/{id}' , [RoleController::class , 'update_permission_to_role'])->name('update_permission_to_role');
            // Route::get('delete/roles/permissions/{id}' , [RoleController::class , 'delete_permission_in_role'])->name('delete_permission_in_role');


            // الطلبات

            Route::get('add/order' , [OrderController::class , 'add'])->name('add_order');
            Route::get('all/orders' , [OrderController::class , 'all'])->name('all_orders');
            Route::post('store/order' , [OrderController::class , 'store'])->name('store_order');
            Route::get('edit/order/{id}' , [OrderController::class , 'edit'])->name('edit_order');
            Route::post('update/order/{id}' , [OrderController::class , 'update'])->name('update_order');
            Route::get('delete/order/{id}' , [OrderController::class , 'delete'])->name('delete_order');
Route::get('order/update_status/{id}',[OrderController::class , 'update_status'])->name('update_order_status');
            // لحوالات
            Route::get('add/transfer' , [TransferController::class , 'add'])->name('add_transfer');
            Route::get('all/transfers' , [TransferController::class , 'all'])->name('all_transfers');
            Route::post('store/transfer' , [TransferController::class , 'store'])->name('store_transfer');
            Route::get('edit/transfer/{id}' , [TransferController::class , 'edit'])->name('edit_transfer');
            Route::post('update/transfer/{id}' , [TransferController::class , 'update'])->name('update_transfer');
            Route::get('delete/transfer/{id}' , [TransferController::class , 'delete'])->name('delete_transfer');

            // لتسويق بالعمولة
            // اسناد عميل لعميل اخر
            Route::get('assign/client' , [MarketingController::class , 'assign'])->name('assign_client');
            Route::get('all/assign/client' , [MarketingController::class , 'all'])->name('all_assign_client');
            Route::post('assign/store' , [MarketingController::class , 'store'])->name('store_assign_client');
            Route::get('edit/assign/client/{id}' , [MarketingController::class , 'edit'])->name('edit_assign_client');
            Route::post('update/assign/client/{id}' , [MarketingController::class , 'update'])->name('update_assign_client');
            Route::get('delete/assign/client/{id}' , [MarketingController::class , 'delete'])->name('delete_assign_client');

            Route::get('clients/tree/{id}' , [MarketingController::class , 'tree'])->name('tree');

            Route::get('settings' , [MarketingController::class , 'settings'])->name('settings');
            Route::post('settings' , [MarketingController::class , 'store_settings'])->name('store_settings');
            Route::get('edit/settings' , [MarketingController::class , 'edit_settings'])->name('edit_settings');
            Route::post('update/settings' , [MarketingController::class , 'update_settings'])->name('update_settings');


            // لتقرير المالي

            Route::get('report/human/manager' , [ReportController::class , 'report_human_manager'])->name('report_human_manager');
            Route::get('report/res/manager' , [ReportController::class , 'report_human_res'])->name('report_res_manager');
            Route::post('store/proof' , [ReportController::class , 'store_proof'])->name('store_proof');
            Route::post('store/proof/res' , [ReportController::class , 'store_proof_res'])->name('store_proof_res');
            Route::get('final/report' , [ReportController::class , 'final_report'])->name('final_report');
            Route::get('order-chart' , [ReportController::class , 'orderChartData'])->name('order_chart');
            Route::get('total-revenue' , [ReportController::class , 'revenueChartData'])->name('Total_revenue');
            Route::get('total-freelancers-dues' , [ReportController::class , 'duesChartData'])->name('Total_freelancers_dues');
            Route::get('total-dues-to-agents' , [ReportController::class , 'revenueAndDuesChartData'])->name('Total_dues_to_agents');
            Route::get('hr-dues' , [ReportController::class , 'hrCommissionChart'])->name('hr_res_dues');
            Route::get('hr-man-dues' , [ReportController::class , 'hrManCommissionChart'])->name('hr_man_dues');
            Route::get('sales-commission' , [ReportController::class , 'salesCommissionChart'])->name('sales_officer');
            Route::get('affiliate-marketers' , [ReportController::class , 'affiliateMarketers'])->name('affiliate_marketers');
            Route::get('sales-manager' , [ReportController::class , 'combinedReport'])->name('sales_manager');
            Route::get('technical-director' , [ReportController::class , 'technical_director'])->name('technical_director');
            Route::get('financial-officer' , [ReportController::class , 'financial_officer'])->name('financial_officer');
            Route::get('ceo-remuneration' , [ReportController::class , 'ceo_remuneration'])->name('ceo_remuneration');
            Route::get('marketing-budget' , [ReportController::class , 'calculateMarketingBudget'])->name('marketing_budget_value');
            Route::get('developer-budget' , [ReportController::class , 'calculateDeveloperBudget'])->name('developer_budget_value');
            Route::get('/net-profit-report', [ReportController::class, 'calculateNetProfit'])->name('net.profit.report');

            // اعدادات الجرد
            Route::get('add/setting' , [ReportController::class , 'setting_view'])->name('add_setting');
            Route::post('store/setting' , [ReportController::class , 'store_setting'])->name('store_setting');
            Route::get('all/settings' , [ReportController::class , 'all_settings'])->name('all_settings');
            Route::get('edit/settings/{id}' , [ReportController::class , 'edit_setting'])->name('edit_setting');
            Route::post('update/settings/{id}' , [ReportController::class , 'update_setting'])->name('update_setting');
            Route::get('delete/settings/{id}' , [ReportController::class , 'delete_setting'])->name('delete_setting');




            Route::get('profile' , [ProfileController::class , 'profile'])->name('profile');



            //management team
            Route::get('all/management_team' , [ManagementTeamController::class,'index'])->name('managementTeam.all');
            Route::get('add/management_team' , [ManagementTeamController::class,'create'])->name('managementTeam.add');
            Route::post('store/managementTeam' , [ManagementTeamController::class,'store'])->name('managementTeam.store');
            Route::get('edit/managementTeam/{id}' , [ManagementTeamController::class,'edit'])->name('managementTeam.edit');
            Route::post('update/managementTeam/{id}' , [ManagementTeamController::class,'update'])->name('managementTeam.update');
            Route::get('delete/managementTeam/{id}' , [ManagementTeamController::class,'destroy'])->name('managementTeam.delete');

        //Sales team
        Route::get('all/SalesTeam' , [SalesTeamController::class,'index'])->name('SalesTeam.all');
        Route::get('add/SalesTeam' , [SalesTeamController   ::class,'create'])->name('SalesTeam.add');
        Route::post('store/SalesTeam' , [SalesTeamController    ::class,'store'])->name('SalesTeam.store');
        Route::get('edit/SalesTeam/{id}' , [SalesTeamController ::class,'edit'])->name('SalesTeam.edit');
        Route::post('update/SalesTeam/{id}' , [SalesTeamController  ::class,'update'])->name('SalesTeam.update');
        Route::get('delete/SalesTeam/{id}' , [SalesTeamController   ::class,'destroy'])->name('SalesTeam.delete');

        Route::get('/inventory-report', [FinalReportController::class, 'generateInventoryReport'])->name('inventory.report');
Route::get('/inventory-update', [ReportController::class, 'inventoryUpdates'])->name('inventory.update');
Route::get('/delete/inventory-update/{id}',[ReportController::class, 'deleteInventoryUpdate'])->name('delete.inventory.updates');
Route::get('/inventory-all',[FinalReportController::class,'getAllInventories'])->name('inventory.all');
Route::get('/inventory-show/{id}',[FinalReportController::class,'showInventor'])->name('inventory.show');
// المكتبة التعليمية

Route::get('/create/educational' , [EducationalController::class , 'create'])->name('create.educational');
Route::post('/store/educational' , [EducationalController::class , 'store'])->name('store.educational');
Route::get('/all/educational' , [EducationalController::class , 'all'])->name('all.educational');
Route::get('/edit/educational/{id}' , [EducationalController::class , 'edit'])->name('edit.educational');
Route::post('/update/educational/{id}' , [EducationalController::class , 'update'])->name('update.educational');
Route::get('/delete/educational/{id}' , [EducationalController::class , 'delete'])->name('delete.educational');






    });
});


