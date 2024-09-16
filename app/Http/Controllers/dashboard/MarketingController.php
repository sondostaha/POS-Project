<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientAttribution;
use App\Models\Marketing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Writer\Ods\Settings;

class MarketingController extends Controller
{
    public function assign(){
        $title = "assign client";
        $description = "assign client";
        $currentUser = Auth::user();

        $clients = Client::where('new_franchise_id' , $currentUser->new_franchise_id)->get();
        return view('marketings.assign_client' , compact("title" , "description" , "clients"));

    }

    public function store(Request $request){
        $data = $request->validate([
            "existing_client_id" => 'required',
            "previous_client_id" => 'required',
        ]);

    $currentUser = Auth::user();
    if ($currentUser && $currentUser->new_franchise_id) {
        $data['new_franchise_id'] = $currentUser->new_franchise_id;
    }

        ClientAttribution::create($data);

        $notification = array(
            'message' => 'تم اسناد العميل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_assign_client' , app()->getLocale())->with($notification);

    }

    public function all(){
        $title = "all assign client";
        $description = "all assign client";
        $currentUser = Auth::user();


       $assigns =  ClientAttribution::where('new_franchise_id' , $currentUser->new_franchise_id)->get();

      return view('marketings.all_assign' , compact("title" , "description" , "assigns"));

    }

    public function edit($language , $id){
        $title = "edit assign client";
        $description = "edit assign client";
        $currentUser = Auth::user();

        $clients = Client::where('new_franchise_id' , $currentUser->new_franchise_id)->get();
        $assign = ClientAttribution::findOrFail($id);

        return view('marketings.edit_assign_client' , compact("title" , "description" , "clients" , "assign"));


    }

    public function update(Request $request , $language , $id ){

        $data = $request->validate([
            "existing_client_id" => 'required',
            "previous_client_id" => 'required',
        ]);

            $currentUser = Auth::user();
    if ($currentUser && $currentUser->new_franchise_id) {
        $data['new_franchise_id'] = $currentUser->new_franchise_id;
    }

        $assign = ClientAttribution::findOrFail($id);

        $assign->update($data);

        $notification = array(
            'message' => 'تم تعديل اسناد العميل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_assign_client' , app()->getLocale())->with($notification);




    }


    public function delete($language , $id) {

        $assign = ClientAttribution::findOrFail($id);

        $assign->delete();

        $notification = array(
            'message' => 'تم حذف اسناد العميل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_assign_client' , app()->getLocale())->with($notification);

    }


    // --------------

    public function tree($language , $id){
        $title = "client tree";
        $description = "client tree";
        $assign = ClientAttribution::FindOrFail($id);
        $currentUser = Auth::user();

        $assigns = ClientAttribution::where('new_franchise_id' , $currentUser->new_franchise_id)->get();

        return view('marketings.clients_tree' , compact("title" , "description" , "assign" , "assigns"));
    }

    public function settings(){
        $Marketing =Marketing::first();
        $title = "الاعدادات";
        $description = "الاعدادات";
        return view('marketings.settings' , compact('Marketing',"title" , "description"));

    }

    public function store_settings(Request $request){

        $data = $request->validate([
            "status" => 'required',
            "level1" => 'required',
        ]);
        $currentUser = Auth::user();
    if ($currentUser && $currentUser->new_franchise_id) {
        $data['new_franchise_id'] = $currentUser->new_franchise_id;
    }

    $marketing = Marketing::first();
    if($marketing)
    {
        $this->update_settings($request);
    }else{
        Marketing::create($data);
    }

        $notification = array(
            'message' => 'تمت الاضافة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function edit_settings(){
        // $setting = Settings::
        $title = "edit setting";
        $description = "edit setting";
        $setting = Marketing::first();
        return view('marketings.edit_settings' , compact("setting" , "title" , "description"));
    }

    public function update_settings(Request $request){

        $data = $request->validate([
            "status" => 'required',
            "level1" => 'required',
        ]);
                    $currentUser = Auth::user();
    if ($currentUser && $currentUser->new_franchise_id) {
        $data['new_franchise_id'] = $currentUser->new_franchise_id;
    }

        $setting = Marketing::first();

        $setting->update($data);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);



    }



}
