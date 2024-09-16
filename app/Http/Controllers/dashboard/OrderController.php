<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Freelancer;
use App\Models\InventoryUpdates;
use App\Models\MainField;
use App\Models\Order;
use App\Models\SubField;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class OrderController extends Controller
{
    public function add(){
        $title = "add order";
        $description = "add order";

        $currentUser = Auth::user();


        $main_fields = MainField::where('new_franchise_id' , $currentUser->new_franchise_id)->get();

        $sub_fields = SubField::where('new_franchise_id' , $currentUser->new_franchise_id)->get();

        $clients = Client::where('new_franchise_id' , $currentUser->new_franchise_id)->get();

        $freelancers = Freelancer::where('new_franchise_id' , $currentUser->new_franchise_id)->get();

        return view('orders.add_order' , compact("clients" , "title" , "description" , "main_fields" , "sub_fields" ,"freelancers"));
    }

    public function store(Request $request) {
        $data = $request->validate([
            "client_id" => 'required',
            "main_field_id" => 'required',
            "sub_field_id" => 'required',
            "desc" => 'required',
            "cvalue" => 'required',
//            "fvalue" => 'required',
            "deadline" => 'required',
            "method" => 'required',
            "proof" => 'required',
            "freelancers" => 'required|array',
            "recieve" => 'required|array',
        ]);
        $data['fvalue'] = 0 ;
        foreach ($data['recieve'] as $recieve) {
            $data['fvalue']  += $recieve;
        }

        $userId = Auth::id();

                        $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }

        // Combine freelancers and their respective compensation into a single array
        $freelancerDetails = [];
        foreach ($data['freelancers'] as $index => $freelancer) {
            $freelancerDetails[] = [
                'name' => $freelancer,
                'compensation' => $data['recieve'][$index],
            ];
        }
        $avalue = ($data['cvalue'] - $data['fvalue']) * 0.20 ;
        Order::create([
            'client_id' => $data['client_id'],
            'main_field_id' => $data['main_field_id'],
            'sub_field_id' => $data['sub_field_id'],
            'user_id' => $userId,
            'desc' => $data['desc'],
            'cvalue' => $data['cvalue'],
            'fvalue' => $data['fvalue'] ,
            'avalue' => $avalue,
            'deadline' => $data['deadline'],
            'method' => $data['method'],
            'proof' => $data['proof'],
            'freelancer_details' => json_encode($freelancerDetails),
            'new_franchise_id' => $data['new_franchise_id']
        ]);

        $notification = [
            'message' => 'تمت الاضافة بنجاح',
            'alert-type' => 'success'
        ];

        return redirect()->route('all_orders', app()->getLocale())->with($notification);
    }



    public function all(){
        $title = "all orders";
        $description = "all orders";
        $currentUser = Auth::user();
        $orders = str_contains($currentUser->role,'المدير') || str_contains($currentUser->role,'مدير')? Order::where('new_franchise_id' , $currentUser->new_franchise_id)->with('inventoryUpdate')->get() :Order::where('new_franchise_id' , $currentUser->new_franchise_id)->where('user_id',$currentUser->id)->with('inventoryUpdate')->get();
        return view('orders.all_orders' , compact("orders" , "title" , "description"));
    }

    public function edit($language , $id){

        $title = "edit order";
        $description = "edit order";
        $currentUser = Auth::user();


        $main_fields = MainField::where('new_franchise_id' , $currentUser->new_franchise_id)->get();
        $sub_fields = SubField::where('new_franchise_id' , $currentUser->new_franchise_id)->get();
        $clients = Client::where('new_franchise_id' , $currentUser->new_franchise_id)->get();
        $freelancers = Freelancer::where('new_franchise_id' , $currentUser->new_franchise_id)->get();
        $order = Order::findOrFail($id);
        return view('orders.edit_order' , compact("clients" , "title" , "description" , "main_fields" , "sub_fields" ,"freelancers" , "order"));

    }

    public function update(Request $request , $language , $id){
    try{
        DB::beginTransaction();

        $data = $request->validate([
            "client_id" => 'required',
            "main_field_id" => 'required',
            "sub_field_id" => 'required',
            "desc" => 'required',
            "cvalue" => 'required',
//            "fvalue" => 'required',
            "deadline" => 'required',
            "method" => 'required',
            "proof" => 'required',
            "freelancers" => 'required|array',
            "recieve" => 'required|array',
        ]);
        $data['status'] = $request->status ?? 'جاري';
        $data['fvalue']  = 0 ;
        foreach ($data['recieve'] as $recieve) {
            $data['fvalue']  += $recieve;
        }
        $userId = Auth::id();

        $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }

        $freelancerDetails = [];
        foreach ($data['freelancers'] as $index => $freelancer) {
            $freelancerDetails[] = [
                'name' => $freelancer,
                'compensation' => $data['recieve'][$index],
            ];
        }
        $order = Order::findOrFail($id);

        $avalue = ($data['cvalue'] - $data['fvalue']) * 0.20 ;
        $order->update([
            'client_id' => $data['client_id'],
            'main_field_id' => $data['main_field_id'],
            'sub_field_id' => $data['sub_field_id'],
            'user_id' => $userId,
            'desc' => $data['desc'],
            'cvalue' => $data['cvalue'],
            'fvalue' => $data['fvalue'] ,
            'avalue' => $avalue,
            'deadline' => $data['deadline'],
            'method' => $data['method'],
            'proof' => $data['proof'],
            'freelancer_details' => json_encode($freelancerDetails),
            'new_franchise_id' => $data['new_franchise_id'],
            'status' => $data['status'],

        ]);
//dd();
        if ($order->status == 'ملغي')
        {
            InventoryUpdates::create([
                'order_id' => $id,
                'cost' => $data['cvalue'],
                'status' => $data['status'],
            ]);
        }

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );
        DB::commit();
        return redirect()->route('all_orders' , app()->getLocale())->with($notification);
    }catch (\Exception $exception)
    {
        DB::rollBack();
        dd($exception->getMessage());
        $notification = array(
            'message' => $exception->getMessage(),
            'alert-type' => 'error'
        );
        return redirect()->route('all_orders' , app()->getLocale())->with($notification);
    }

    }

    public function delete($language , $id){

        $order = Order::findOrFail($id);

        $order->delete();


        $notification = array(
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_orders' , app()->getLocale())->with($notification);

    }
    public function update_status( $language , $id){
        $order =  Order::findOrFail($id);

        $order->update(['status' => 'مسلم']);
//        dd($order);

        $notification = array(
            'message' => 'تم تغيير حاله الطلب اي مسلم بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_orders' , app()->getLocale())->with($notification);

    }




}
