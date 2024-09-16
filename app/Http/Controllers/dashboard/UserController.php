<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function add()
    {
        $title = "Add Users";
        $description = "Users";
        $currentUser = Auth::user();
        $roles = Role::all();
        $managers = User::role('مسؤول مبيعات')->where('new_franchise_id' , $currentUser->new_franchise_id)->get(); // Fetch users with the role 'مسؤول مبيعات'
        return view('users.add_user', compact('title', 'description', 'roles', 'managers'));
    }

public function store(Request $request)
{
    // Validate the incoming request data
    $data = $request->validate([
        'username' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:6',
        'role' => 'required|string|exists:roles,name',
        'about' => 'required|string',
        'phone' => 'required|unique:users,phone',
        'wphone' => 'required',
        'facebook' => 'required|string',
        'pay' => 'required',
        'vcashe' => 'required',
        'card' => 'required|unique:users,card',
        'manager_id' => 'nullable|exists:users,id', // Validate the manager_id
    ]);

    // Hash the password
    $data['password'] = Hash::make($data['password']);
    
    $currentUser = Auth::user();
    if ($currentUser && $currentUser->new_franchise_id) {
        $data['new_franchise_id'] = $currentUser->new_franchise_id;
    }

    // Create the user
    $user = User::create([
        'username' => $data['username'],
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => $data['password'],
        'about' => $data['about'],
        'phone' => $data['phone'],
        'role' => $data['role'],
        'wphone' => $data['wphone'],
        'facebook' => $data['facebook'],
        'pay' => $data['pay'],
        'vcashe' => $data['vcashe'],
        'card' => $data['card'],
        'manager_id' => $data['manager_id'],
        'new_franchise_id' => $data['new_franchise_id'] ?? null, // Add new_franchise_id if it exists
    ]);

    // Assign the specified role to the user
    // $user->assignRole($request->role);
    
    if ($request->filled('role')) {
        $user->syncRoles($request->role);
    }
    

    // Create a notification message
    $notification = [
        'message' => 'تمت الأضافة بنجاح',
        'alert-type' => 'success'
    ];

    // Redirect to the user listing page with the notification
    return redirect()->route('get_user', app()->getLocale())->with($notification);
}

    public function all(){
        $title = "Users";
        $description = "Users";
        $currentUser = Auth::user();

        $users = User::with('roles')->where('new_franchise_id' , $currentUser->new_franchise_id)->get(); // Eager load roles
        return view('users.all_users',compact('title','description','users'));
    }


    public function edit_users($language , $id){
        $title = "Edit Users";
        $description = "Edit Users";
        $user = User::findOrFail($id);

        $roles = Role::all();
        $managers = User::role('مسؤول مبيعات')->get();


        return view('users.edit_user' , compact("title" , "managers" ,"description" , "user" , "roles" ));
        
    }

 public function update_users(Request $request, $language, $id)
{
    // Validate the incoming request data
    $data = $request->validate([
        'username' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'nullable|string|min:6', // Make password nullable for updates
        'role' => 'nullable|string|exists:roles,name', // Validate role if provided
        'about' => 'required|string',
        'phone' => 'required|string',
        'wphone' => 'required|string',
        'facebook' => 'required|string',
        'pay' => 'required',
        'vcashe' => 'required',
        'card' => 'required|string',
        'manager_id' => 'nullable|exists:users,id', // Validate the manager_id
    ]);

    // Find the user by ID
    $user = User::findOrFail($id);
    
        $currentUser = Auth::user();
    if ($currentUser && $currentUser->new_franchise_id) {
        $data['new_franchise_id'] = $currentUser->new_franchise_id;
    }

    // Check if password is provided and hash it
    if (!empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
    } else {
        // Exclude password from the data array if not provided
        unset($data['password']);
    }

    // Update the user with validated data
    $user->update($data);

    // Assign the specified role to the user if provided
    if ($request->filled('role')) {
        $user->syncRoles($request->role);
    }

    // Create a notification message
    $notification = [
        'message' => 'تم التعديل بنجاح',
        'alert-type' => 'success'
    ];

    // Redirect to the user listing page with the notification
    return redirect()->route('get_user', app()->getLocale())->with($notification);
}


    public function delete_users($language , $id){
        $user = User::findOrFail($id);

        $user->delete();

        $notification = array(
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('get_user',app()->getLocale())->with($notification);

    }

}
