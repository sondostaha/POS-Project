<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\NewFranchise;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;



class FranchiseController extends Controller
{


    public function add_new(){
        $title = "add New Franchise";
        $description = "add New Franchise";
        return view('franchise.add_new_franchise',compact('title','description'));
    }

    public function store_new(Request $request)
    {
        $data = $request->validate([
            "name" => 'required',
            "username" => 'required',
            "allname" => 'required',
            "email" => 'required|unique:new_franchises,email',
            "password" => 'required',
            "access" => 'nullable|in:true,false', // Validate access as enum
        ]);
        
        $encryptedPassword = Hash::make($data['password']);
    
       $newFranchise = NewFranchise::create([
            "name" => $data['name'],
            "username" => $data['username'],
            "allname" => $data['allname'],
            "email" => $data['email'],
            "password" => $encryptedPassword,
            "access" => $request->has('access') ? 'true' : 'false', // Set access to true if checked, else false
        ]);
        
       $user = User::create([
        "name" => $data['username'],
        "username" => $data['allname'],
        "email" => $data['email'],
        "role" => 'المدير التنفيذي',
        "password" => $encryptedPassword,
        "new_franchise_id" => $newFranchise->id, // Use the ID of the newly created franchise
    ]);
    
          // Assign role to user
          $role = Role::where('name', 'المدير التنفيذي')->first();
          $user->assignRole($role);
              
        $notification = array(
            'message' => 'تمت الأضافة بنجاح',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all_new_franchise', app()->getLocale())->with($notification);
    }
    

    public function all_new(){

        $title = "all New Franchise";
        $description = "all New Franchise";
        $franchises = NewFranchise::all();

        return view('franchise.all_new_franchises',compact('title','description' , 'franchises'));

    }

    public function edit_new($language , $id){
        $title = "edit New Franchise";
        $description = "edit New Franchise";
        $franchise = NewFranchise::findOrFail($id);
        return view('franchise.edit_new_franchise',compact('title','description' , 'franchise'));

    }

    public function update_new(Request $request , $language , $id){

        $data = $request->validate([
            "name" => 'required',
            "username" => 'required',
            "allname" => 'required',
            "email" => 'required',
            "password" => 'nullable',
            "access" => 'nullable|in:true,false', // Validate access as enum

        ]);

        // Find the existing franchise and user
    $newFranchise = NewFranchise::findOrFail($id);
    $user = User::where('new_franchise_id', $newFranchise->id)->firstOrFail();

    // Update the franchise
    $newFranchise->update([
        "name" => $data['name'],
        "username" => $data['username'],
        "allname" => $data['allname'],
        "email" => $data['email'],
        "password" => $data['password'] ? bcrypt($data['password']) : $newFranchise->password,
        "access" => $request->has('access') ? 'true' : 'false',
    ]);

    // Update the user
    $user->update([
        "name" => $data['username'],
        "username" => $data['allname'],
        "email" => $data['email'],
        "password" => $data['password'] ? bcrypt($data['password']) : $user->password,
        "new_franchise_id" => $newFranchise->id,
    ]);

    // Assign the role to the user if needed
    $role = Role::where('name', 'المدير التنفيذي')->first();
    if (!$user->hasRole($role)) {
        $user->syncRoles([$role]);
    }


        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_new_franchise',app()->getLocale())->with($notification);


    }

    public function delete($language , $id){
        $franchise = NewFranchise::findOrFail($id);
        $franchise->delete();
        $notification = array(
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('all_new_franchise',app()->getLocale())->with($notification);

    }
}
