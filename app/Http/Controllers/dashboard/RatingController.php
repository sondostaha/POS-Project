<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Freelancer;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add_rating(){
        $title = "Add Rating";
        $description = "Add Rating";
        $currentUser = Auth::user();

        $freelancers = Freelancer::where('new_franchise_id' , $currentUser->new_franchise_id)->get();
        return view('freelancers.add_rating' , compact("title" , "description" , "freelancers"));

    }

    public function store_rating(Request $request){

        isset($request->id) ?? $request->freelancer_id = $request->id;
        $data = $request->validate([
            'rating' => 'required',
            'freelancer_id' => 'required',
            'comment' => 'nullable'
        ]);

                $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }

        Rating::create($data);

        $notification = array(
            'message' => 'تمت الاضافة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_rating' , app()->getLocale())->with($notification);

    }

    public function all_rating(){
        $title = "All Rating";
        $description = "All Rating";
                $currentUser = Auth::user();

        $ratings = Rating::where('new_franchise_id' , $currentUser->new_franchise_id)->get();

        return view('freelancers.all_rating' , compact("title" , "description" , "ratings"));

    }

    public function edit_rating($language , $id){
        $title = "Edit Rating";
        $description = "Edit Rating";
        $currentUser = Auth::user();

        $rating = Rating::findOrFail($id);
        $freelancers = Freelancer::where('new_franchise_id' , $currentUser->new_franchise_id)->get();

        return view('freelancers.edit_rating' , compact("title" , "description" , "rating" , "freelancers"));
    }

    public function update_rating(Request $request , $language , $id ){

        $data = $request->validate([
            'rating' => 'required',
            'freelancer_id' => 'required',
            'comment' => 'nullable'
        ]);


        $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }

        $rating = Rating::findOrFail($id);


        $rating->update($data);


        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_rating' , app()->getLocale())->with($notification);

    }


    public function delete_rating($language , $id){
        $rating = Rating::findOrFail($id);
        $rating->delete();
        $notification = array(
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_rating' , app()->getLocale())->with($notification);

    }
}
