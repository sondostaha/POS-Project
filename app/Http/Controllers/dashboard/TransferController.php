<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TransferController extends Controller
{
    public function add(){
        $title = "add transfer";
        $description = "add transfer";
        $currentUser = Auth::user();

        $agents = User::whereHas('roles', function ($query) {
            $query->where('name', 'وكيل مبيعات');
        })->where('new_franchise_id' , $currentUser->new_franchise_id)->get();

        $officers = User::whereHas('roles', function ($query) {
            $query->where('name', 'مسؤول مبيعات');
        })->where('new_franchise_id' , $currentUser->new_franchise_id)->get();

        
        return view('transfers.add_transfer' , compact("title" , "description" , "agents" , "officers"));
    }

    public function store(Request $request){

        $data = $request->validate([
            "number" => 'required',
            "value" => 'required',
            "proof" => 'required',
            "officer" => 'required',
            "agent" => 'required',
            "method" => 'required',
        ]);
        
                $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }

        Transfer::create($data);

        $notification = array(
            'message' => 'تمت الاضافة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_transfers' , app()->getLocale())->with($notification);

    }
    

    public function all(){
        $title = "all transfers";
        $description = "all transfers";
        $currentUser = Auth::user();

        $transfers = Transfer::where('new_franchise_id' , $currentUser->new_franchise_id)->get();

        return view('transfers.all_transfers' , compact("title" , "description" , "transfers"));

    }

    public function edit($language , $id){

        $title = "edit transfer";
        $description = "edit transfer";
        $transfer = Transfer::findOrFail($id);
        
        $currentUser = Auth::user();

        $agents = User::whereHas('roles', function ($query) {
            $query->where('name', 'وكيل مبيعات');
        })->where('new_franchise_id' , $currentUser->new_franchise_id)->get();

        $officers = User::whereHas('roles', function ($query) {
            $query->where('name', 'مسؤول مبيعات');
        })->where('new_franchise_id' , $currentUser->new_franchise_id)->get();


        return view('transfers.edit_transfer' , compact("title" , "description" , "transfer" , "agents" , "officers"));

    }

    public function update(Request $request , $language , $id){

        $data = $request->validate([
            "number" => 'required',
            "value" => 'required',
            "proof" => 'required',
            "officer" => 'required',
            "agent" => 'required',
            "method" => 'required',
        ]);
        
                $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }

        $transfer = Transfer::findOrFail($id);

        $transfer->update($data);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_transfers' , app()->getLocale())->with($notification);


    }

    public function delete($language , $id){
        $transfer = Transfer::findOrFail($id);

        $transfer->delete();

        
        $notification = array(
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_transfers' , app()->getLocale())->with($notification);
    }

    
}
