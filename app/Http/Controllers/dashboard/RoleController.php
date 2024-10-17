<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{


    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $title = "roles";
        $description = "roles";

        return view('roles.index', compact('roles', 'permissions' , 'title' , 'description'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // dd($request->permissions);
        // إنشاء الدور الجديد
        $role = Role::create(['name' => $request->name]);

        // جلب معرّفات الصلاحيات المختارة باستخدام أسمائها
        $permissionIds = Permission::whereIn('name', $request->input('permissions'))->pluck('id')->toArray();

        // ربط الصلاحيات بالدور
        $role->syncPermissions($permissionIds);

            $notification = [
        'message' => 'تم اضافة الرتبة بنجاح',
        'alert-type' => 'success'
    ];

        return redirect()->route('roles.all' , app()->getLocale())->with($notification);
    }

    public function all(){
        $title = "all roles";
        $description = "all roles";
        $roles = Role::all();
        return view('roles.all', compact('roles' , 'title' , 'description'));
    }

    public function edit($language, $id)
{
            $title = "edit roles";
        $description = "edit roles";
    $role = Role::findOrFail($id);
    $permissions = Permission::all()->groupBy(function ($item, $key) {
        return explode(' ', $item->name)[1]; // Group by the section name
    });

    return view('roles.edit', compact('role', 'permissions' , 'title' , 'description'));
}

public function update(Request $request, $language, $id)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'permissions' => 'array', // Validate that permissions is an array
        'permissions.*' => 'string|exists:permissions,name' // Validate each permission
    ]);

    $role = Role::findOrFail($id);
    $role->name = $data['name'];
    $role->save();

    // Sync the role's permissions
    $role->syncPermissions($data['permissions']);

    $notification = [
        'message' => 'تم التعديل بنجاح',
        'alert-type' => 'success'
    ];

    return redirect()->route('roles.all', app()->getLocale())->with($notification);
}

public function destroy($language, $id)
{
    $role = Role::findOrFail($id);
    $role->delete();

    $notification = [
        'message' => 'تم الحذف بنجاح',
        'alert-type' => 'success'
    ];

    return redirect()->route('roles.all', app()->getLocale())->with($notification);
}




    // public function edit(Role $role)
    // {
    //     $permissions = Permission::all();
    //     return view('roles.edit', compact('role', 'permissions'));
    // }

    // public function update(Request $request, Role $role)
    // {
    //     $role->syncPermissions($request->permissions);

    //     return redirect()->route('roles.index');
    // }

    // public function destroy(Role $role)
    // {
    //     $role->delete();

    //     return redirect()->route('roles.index');
    // }



    // public function add(){
    //     $title = "Add Permission";
    //     $description = "Add Permission";
    //     return view('permissions.add_permission' ,compact("title" , "description"));

    // }


    // public function all(){
    //     $title = "permissions";
    //     $description = "permissions";
    //     $permissions = Permission::all();
    //     return view('permissions.all_permissions' , compact("title" , "description" , "permissions"));
    // }

    // public function store(Request $request){

    //     $permissions = Permission::create([
    //         'name' => $request->name,
    //         'group_name' => $request->group_name,
    //     ]);

    //     $notification = array(
    //         'message' => 'تمت الأضافة بنجاح',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('all_permissions' , app()->getLocale())->with($notification);


    // }

    // public function edit($language , $id){
    //     $title = "Edit Permissions";
    //     $description = "Edit Permissions";
    //     $permission = Permission::findOrFail($id);
    //     return view('permissions.edit_permission' , compact("title" , "description" , "permission"));

    // }

    // public function update(Request $request , $language , $id ){


    //     Permission::findOrFail($id)->update([
    //         'name' => $request->name,
    //         'group_name' => $request->group_name,
    //     ]);

    //     $notification = array(
    //         'message' => 'تم التعديل بنجاح',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('all_permissions' , app()->getLocale())->with($notification);


    // }


    // public function delete($language  , $id){


    //     Permission::findOrFail($id)->delete();

    //     $notification = array(
    //         'message' => 'تم الحذف بنجاح',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('all_permissions' , app()->getLocale())->with($notification);

    // }

    // public function add_role(){

    //     $title = "Add Role";
    //     $description = "Add Role";

    //     return view('roles.add_role' , compact("title" , "description"));

    // }

    // public function all_roles(){
    //     $title = "Roles";
    //     $description = "Roles";
    //     $permissions = Permission::all();
    //     $roles = Role::all();
    //     return view('roles.all_roles' , compact("title" , "description" , "roles"));
    // }


    // public function store_roles(Request $request){

    //     Role::create([
    //         'name' => $request->name,
    //     ]);

    //     $notification = array(
    //         'message' => 'تمت الأضافة بنجاح',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('all_roles' , app()->getLocale())->with($notification);

    // }

    // public function edit_role($language , $id){
    //     $title = "Edit Role";
    //     $description = "Edit Role";
    //     $role = Role::findOrFail($id);
    //     return view('roles.edit_role' , compact("title" , "description" , "role"));

    // }

    // public function update_role(Request $request , $language , $id ){


    //     Role::findOrFail($id)->update([
    //         'name' => $request->name,
    //     ]);

    //     $notification = array(
    //         'message' => 'تم التعديل بنجاح',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('all_roles' , app()->getLocale())->with($notification);

    // }

    // public function delete_role($language  , $id){


    //     Permission::findOrFail($id)->delete();

    //     $notification = array(
    //         'message' => 'تم الحذف بنجاح',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('all_permissions' , app()->getLocale())->with($notification);

    // }


    // public function add_permission_to_role(){
    //     $title = 'Add permission to role';
    //     $description = 'Add permission to role';
    //     $roles = Role::all();
    //     $permissions = Permission::all();
    //     $permission_group = User::getPermissionGroups();
    //     // $permission_group = User::getPermissionGroups();
    //     return view('roles.add_roles_permission' , compact("title" , "description" , "roles" , "permissions" , "permission_group"));

    // }

    // public function store_permission_to_role(Request $request){

    //     $data = [];
    //     $permissions = $request->permission;

    //     foreach($permissions as $item){

    //         $data['role_id'] = $request->role_id;
    //         $data['permission_id'] = $item;

    //         DB::table('role_has_permissions')->insert($data);

    //     }

    //     $notification = array(
    //         'message' => 'تمت الأضافة بنجاح',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('all_roles_permissions' ,app()->getLocale() )->with($notification);

    // }


    // public function all_permission_to_role(){
    //     $title = 'All permission in role';
    //     $description = 'All permission in role';
    //     $roles = Role::all();
    //     return view('roles.all_roles_permissions' , compact("roles" , "title" , "description"));
    // }

    // public function edit_permission_to_role($language , $id){
    //     $title = 'Edit permission in role';
    //     $description = 'Edit permission in role';
    //     $role = Role::findOrFail($id);
    //     $permissions = Permission::all();
    //     $permission_group = User::getPermissionGroups();

    //     return view('roles.edit_roles_permission' , compact("title" , "description" ,"role" ,"permissions" ,"permission_group"));
    // }

    // public function update_permission_to_role(Request $request , $language , $id ){

    //     $role = Role::FindOrFail($id);
    //     $permissions = $request->permission;

    //     if (!empty($permissions)) {
    //         $role->permissions()->sync($permissions);
    //         // $role->syncPermissions($permissions);
    //     }else{
    //         echo "error";
    //     }

    //     $notification = array(
    //         'message' => 'تم التعديل بنجاح',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('all_roles_permissions' , app()->getLocale())->with($notification);

    // }

    // public function delete_permission_in_role( $language , $id){

    //     $role = Role::findOrFail($id);

    //     if (!is_null($role)) {
    //         $role->delete();
    //     }

    //     $notification = array(
    //         'message' => 'تم الحذف بنجاح',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('all_roles_permissions' , app()->getLocale())->with($notification);

    // }



}
