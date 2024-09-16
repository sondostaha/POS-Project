<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Educational;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class EducationalController extends Controller
{
    public function create(){
        $title = "المكتبة التلعليمية";
        $description = "المكتبة التلعليمية";
        $educational = Educational::first();

        return view('educationals.create' , compact( 'educational',"title" , "description"));
    }

    public function store(Request $request){
        $data = $request->validate([
            "text" => 'required',
            ]);
        $educational = Educational::first();
        if($educational){
            $educational->update($data);
        }else{
            Educational::create($data);

        }

                $notification = [
        'message' => 'تمت الأضافة بنجاح',
        'alert-type' => 'success'
    ];

        return redirect()->back()->with($notification);


    }


    public function all(){
        $educationals = Educational::all();
                $title = "المكتبة التلعليمية";
        $description = "المكتبة التلعليمية";

    return view('educationals.all' , compact("title" , "description" , "educationals"));


    }



    public function edit($language , $id){
        $educational = Educational::findOrFail($id);


        $title = "المكتبة التلعليمية";
        $description = "المكتبة التلعليمية";

                return view('educationals.edit' , compact( "title" , "description" , "educational"));


    }


        public function update(Request $request, $language, $id){
            $educational = Educational::findOrFail($id);

        $data = $request->validate([
            "text" => 'required',
            ]);

            $educational->update($data);


                $notification = [
                    'message' => 'تمت التعديل بنجاح',
                    'alert-type' => 'success'
                ];

        return redirect()->route('all.educational' , app()->getLocale())->with($notification);


    }

    public function delete($language , $id){
            $educational = Educational::findOrFail($id);

        $educational->delete();

        $notification = array(
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all.educational',app()->getLocale())->with($notification);

    }









}
