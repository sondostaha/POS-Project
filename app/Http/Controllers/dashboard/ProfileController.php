<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile(){
        $title = "profile";
        $description = "profile";
        return view('profile.profile' , compact("title" , "description"));
    }

    public function edit_email(Request $request , $language ,$id){


      $data =  $request->validate([
            "email" => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'email' => $data['email']
        ]);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function edit_about(Request $request , $language ,$id){


      $data =  $request->validate([
            "about" => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'about' => $data['about']
        ]);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function edit_phone(Request $request , $language ,$id){


      $data =  $request->validate([
            "phone" => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'phone' => $data['phone']
        ]);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function edit_vcash(Request $request , $language ,$id){


      $data =  $request->validate([
            "vcashe" => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'vcashe' => $data['vcashe']
        ]);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function edit_card(Request $request , $language ,$id){


      $data =  $request->validate([
            "card" => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'card' => $data['card']
        ]);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function edit_facebook(Request $request , $language ,$id){

      $data =  $request->validate([
            "facebook" => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'facebook' => $data['facebook']
        ]);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function edit_wphone(Request $request , $language ,$id){

      $data =  $request->validate([
            "wphone" => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'wphone' => $data['wphone']
        ]);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
    public function edit_name(Request $request , $language ,$id){

      $data =  $request->validate([
            "name" => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $data['name']
        ]);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function edit_password(Request $request , $language ,$id){

      $data =  $request->validate([
            "old_password" => 'required',
            "password" => 'required',
        ]);

        $user = User::findOrFail($id);

    //    $old_password = bcrypt($data['old_password']);


       if (!Hash::check($data['old_password'], $user->password)) {
        $notification = array(
            'message' => 'كلمة السر الحالية غير صحيحة',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }

    $user->password = Hash::make($data['password']);
    $user->save();


        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }



}
