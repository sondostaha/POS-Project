<?php

namespace App\Http\Controllers\dashboard;

use App\Exports\FreelancerExport;
use App\Http\Controllers\Controller;
use App\Imports\FreelancerImport;
use App\Models\Field;
use App\Models\Freelancer;
use App\Models\Holiday;
use App\Models\MainField;
use App\Models\Rating;
use App\Models\RequestFreelancer;
use App\Models\SubField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use CSV;
use Illuminate\Support\Facades\Auth;
use App\Imports\FreelancersImport;

// use Excel;
class FreelancerController extends Controller
{

    // main fields

    public function add_field(){
        $title = "Add Fields";
        $description = "Add Fields";
        return view('freelancers.add_main_field',compact('title','description'));
    }

    public function all_field(){
        $title = "Fields";
        $description = "Fields";
        $userId = Auth::id();

        $fields = MainField::where('user_id' , $userId)->get();
        return view('freelancers.all_main_field',compact('title','description','fields'));

    }

    public function store_field(Request $request){
        $title = "Fields";
        $description = "Fields";

        $data = $request->validate([
            "title" => 'string|required',
        ]);

        $userId = Auth::id();

            $currentUser = Auth::user();
            if ($currentUser && $currentUser->new_franchise_id) {
                $data['new_franchise_id'] = $currentUser->new_franchise_id;
            }


        MainField::create([
            'title' => $data['title'],
            'user_id' => $userId,
            'new_franchise_id' => $data['new_franchise_id'],
        ]);

        $notification = array(
            'message' => 'تمت الأضافة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_fields',app()->getLocale())->with($notification);
    }

    public function edit_field($language , $id){
        $title = "Edit Fields";
        $description = "Edit Fields";
        $field = MainField::findOrFail($id);

        return view('freelancers.edit_main_field' , compact("title" , "field" , "description" ));

    }

    public function update_field(Request $request , $language , $id ){
        $title = "Fields";
        $description = "Fields";

        $data = $request->validate([
            "title" => 'string|required',
        ]);

        $field = MainField::findOrFail($id);

        $userId = Auth::id();

                    $currentUser = Auth::user();
            if ($currentUser && $currentUser->new_franchise_id) {
                $data['new_franchise_id'] = $currentUser->new_franchise_id;
            }


        $field->update([
            'title'=> $data['title'],
            'user_id'=> $userId,
            'new_franchise_id'=> $data['new_franchise_id'],
        ]);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_fields',app()->getLocale())->with($notification);

    }

    public function delete_field($language , $id){
        $field = MainField::findOrFail($id);

        $field->delete();

        $notification = array(
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_fields' , app()->getLocale() )->with($notification);

    }



    // sub fields


    public function add_sub_field(){
        $userId = Auth::id();

        $main_fields = MainField::where('user_id' , $userId )->get();
        $title = "Add Sub Fields";
        $description = "Add Sub Fields";
        return view('freelancers.add_sub_field',compact('title','description' , 'main_fields'));

    }


    public function all_sub_field(){
        $title = "Fields";
        $description = "Fields";
        $userId = Auth::id();
        $subfields = SubField::where('user_id' , $userId )->get();
        return view('freelancers.all_sub_field',compact('title','description','subfields'));

    }

    public function store_sub_field(Request $request){
        $title = "Fields";
        $description = "Fields";

        $userId = Auth::id();

        $data = $request->validate([
            "title" => 'string|required',
            "main_field_id" => 'string|required',
        ]);

                $currentUser = Auth::user();
            if ($currentUser && $currentUser->new_franchise_id) {
                $data['new_franchise_id'] = $currentUser->new_franchise_id;
            }

        SubField::create([
            'title' => $data['title'],
            'main_field_id' => $data['main_field_id'],
            'user_id' => $userId,
            'new_franchise_id' => $data['new_franchise_id'],
        ]);

        $notification = array(
            'message' => 'تمت الأضافة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_sub_fields',app()->getLocale())->with($notification);
    }

    public function edit_sub_field($language , $id){
        $title = "Edit Sub Fields";
        $description = "Edit Sub Fields";
        $userId = Auth::id();

        $field = SubField::findOrFail($id);

        $main_fields = MainField::where('user_id' , $userId )->get();


        return view('freelancers.edit_sub_field' , compact("title" , "field" , "description" , "main_fields" ));

    }

    public function update_sub_field(Request $request , $language , $id ){
        $title = "Fields";
        $description = "Fields";

        $data = $request->validate([
            "title" => 'string|required',
            "main_field_id" => 'string|required',
        ]);

        $field = SubField::findOrFail($id);
        $userId = Auth::id();

                        $currentUser = Auth::user();
            if ($currentUser && $currentUser->new_franchise_id) {
                $data['new_franchise_id'] = $currentUser->new_franchise_id;
            }



        $field->update([
            'title' => $data['title'],
            'main_field_id' => $data['main_field_id'],
            'user_id' => $userId,
            'new_franchise_id' => $data['new_franchise_id'],
        ]);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_sub_fields',app()->getLocale())->with($notification);

    }

    public function delete_sub_field($language , $id){
        $field = SubField::findOrFail($id);

        $field->delete();

        $notification = array(
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_sub_fields' , app()->getLocale() )->with($notification);

    }


    // freelancers

    public function add(){
        $title = "add-freelancer";
        $description = "Freelancers";
        $userId = Auth::id();
        $mainfields = MainField::where('user_id' , $userId )->get();
        $subfields = SubField::where('user_id' , $userId )->get();

        return view('freelancers.add_freelancer',compact('title','description','mainfields','subfields'));
    }

    public function all(){
        $title = "Freelancers";
        $description = "Freelancers";
        $userId = Auth::id();

        $freelancers = Freelancer::where('user_id' , $userId)->get();

        return view('freelancers.all',compact('title','description','freelancers'));
    }

    public function filter(Request $request){
        $title = "Freelancers";
        $description = "Freelancers";

        if ($request->filterB == 'hot') {
            // select all freelancer where rate >= 7
            $freelancers = Freelancer::whereHas('ratings', function ($query) {
                $query->where('rating', '>=', 7);
            })->get();

            return view('freelancers.all',compact('title','description','freelancers'));

            // return redirect()->route('get_freelancer', app()->getLocale())->with('freelancers', $freelancers);
        }elseif($request->filterB == 'cold'){

            $freelancers = Freelancer::whereHas('ratings', function ($query) {
                $query->whereBetween('rating', [4, 7]);
            })->get();

            return view('freelancers.all',compact('title','description','freelancers'));

        }elseif($request->filterB == 'archive') {
            $freelancers = Freelancer::whereHas('ratings', function ($query) {
                $query->whereBetween('rating', [0, 4]);
            })->get();

            return view('freelancers.all',compact('title','description','freelancers'));
        }else{
            $freelancers = Freelancer::all();

            return view('freelancers.all',compact('title','description','freelancers'));
        }

    }

    public function show($language , $id){
        $title = "Show Freelancers";
        $description = "Show Freelancers";
        $freelancer = Freelancer::where('id',$id)->with('ratings')->first();
        $total_ratting = $freelancer->ratings->sum('rating');
        $count_rating = $freelancer->ratings->count();
        $total_value_of_rating = $total_ratting / $count_rating ;
 //        dd($freelancer);
        return view('freelancers.show_freelancer' , compact("freelancer" , 'total_value_of_rating',"title" , "description" ));
    }

    public function holiday($language , $id){

        $freelancer = Freelancer::findOrFail($id);

        Holiday::create([
            "freelancer_id" => $freelancer->id
        ]);


        $notification = array(
            'message' => 'تم اضافة المستقل لأجازة',
            'alert-type' => 'success'
        );


        return redirect()->route('get_freelancer',app()->getLocale())->with($notification);

    }

    public function return_holiday($language , $id){

        // $freelancer = Holiday::where('freelancer_id' , $id)->get();

        $freelancer = Freelancer::findOrFail($id);

        if ($freelancer) {
            $freelancer->holidays()->delete();

            $notification = array(
                'message' => 'تمت عودة المستقل من الأجازة',
                'alert-type' => 'success'
            );

        return redirect()->route('get_freelancer',app()->getLocale())->with($notification);

        }


        // $holiday->delete();

        $notification = array(
            'message' => 'تمت عودة المستقل من الأجازة',
            'alert-type' => 'success'
        );

        return redirect()->route('get_freelancer',app()->getLocale())->with($notification);





    }

    public function store_freelancer(Request $request){
        $title = "Freelancers";
        $description = "Freelancers";

        $data = $request->validate([
            "name" => 'string|min:3|required',
            "age" => 'numeric|required',
            "country" => 'string|required',
            "type" => 'string|required',
            "certificate" => 'string|required',
            "main_field_id" => 'required',
            "sub_field_id" => 'required',
            "products" => 'string|required',
            "languages" => 'string|required',
            "wphone" => 'required|digits:11',
            "vphone" => 'required||digits:11',
            "email" => 'string|required|email',
            "cv" => 'string|required',
        ]);

        $userId = Auth::id();

            $currentUser = Auth::user();
            if ($currentUser && $currentUser->new_franchise_id) {
                $data['new_franchise_id'] = $currentUser->new_franchise_id;
            }

        Freelancer::create([

            'name' => $data['name'],
            'age' => $data['age'],
            'country' => $data['country'],
            'type' => $data['type'],
            'certificate' => $data['certificate'],
            'main_field_id' => $data['main_field_id'],
            'sub_field_id' => $data['sub_field_id'],
            'products' => $data['products'],
            'languages' => $data['languages'],
            'wphone' => $data['wphone'],
            'vphone' => $data['vphone'],
            'email' => $data['email'],
            'cv' => $data['cv'],
            'user_id' => $userId,
            'new_franchise_id' => $data['new_franchise_id']

        ]);

        $notification = array(
            'message' => 'تمت الأضافة بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('get_freelancer',app()->getLocale())->with($notification);
    }



    public function edit_freelancer($language, $id){

        $title = "Edit-Freelancer";
        $description = "Edit-Freelancer";
        $userId = Auth::id();

        $mainfields = MainField::where('user_id' , $userId )->get();
        $subfields = SubField::where('user_id' , $userId )->get();
        $freelancer = Freelancer::findOrFail($id);
        return view('freelancers.edit_freelancer' , compact("title" , "description" , "mainfields" , "subfields" , "freelancer"));
    }

    public function update_freelancer(Request $request , $language ,$id ){

        $data = $request->validate([
            "name" => 'string|min:3|required',
            "age" => 'numeric|required',
            "country" => 'string|required',
            "type" => 'string|required',
            "certificate" => 'string|required',
            "main_field_id" => 'required',
            "sub_field_id" => 'required',
            "products" => 'string|required',
            "languages" => 'string|required',
            "wphone" => 'required|digits:11',
            "vphone" => 'required||digits:11',
            "email" => 'string|required|email',
            "cv" => 'string|required',
        ]);

        $userId = Auth::id();

            $currentUser = Auth::user();
            if ($currentUser && $currentUser->new_franchise_id) {
                $data['new_franchise_id'] = $currentUser->new_franchise_id;
            }

        $freelancer = Freelancer::findOrFail($id);


        $freelancer->update([
            'name' => $data['name'],
            'age' => $data['age'],
            'country' => $data['country'],
            'type' => $data['type'],
            'certificate' => $data['certificate'],
            'main_field_id' => $data['main_field_id'],
            'sub_field_id' => $data['sub_field_id'],
            'products' => $data['products'],
            'languages' => $data['languages'],
            'wphone' => $data['wphone'],
            'vphone' => $data['vphone'],
            'email' => $data['email'],
            'cv' => $data['cv'],
            'user_id' => $userId,
            'new_franchise_id' => $data['new_franchise_id']
        ]);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );


        return redirect()->route('get_freelancer',app()->getLocale())->with($notification);
    }

    public function delete_freelancer( $language , $id){

        // dd($id);

        $freelancer = Freelancer::findOrFail($id);

        $freelancer->delete();

        $notification = array(
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        );

        // dd(app()->getLocale());
        return redirect()->route('get_freelancer' , app()->getLocale() )->with($notification);

    }

    public function delete_all_freelancers(){
        Freelancer::truncate();

        $notification = array(
            'message' => 'تم حذف الكل',
            'alert-type' => 'success'
        );

        // dd(app()->getLocale());
        return redirect()->back()->with($notification);

    }


    public function exportFreelancer(){
        return Excel::download(new FreelancerExport, 'freelancer.csv');
    }


    // import

public function saveFreelancers(Request $request)
{
    $path = $request->file('file')->getRealPath();
    $allData = Excel::toArray([], $path, null, \Maatwebsite\Excel\Excel::XLSX);
    $userId = Auth::id();

        $currentUser = Auth::user();
    if ($currentUser && $currentUser->new_franchise_id) {
        $new_franchise_id = $currentUser->new_franchise_id;
    }

    if (count($allData) > 0) {
        // Remove the first row assuming it's headers or descriptive labels
        unset($allData[0][0]); // Remove the first element which contains labels

        foreach ($allData[0] as $row) {
            // Check if the row contains any non-empty data
            if (!empty(array_filter($row))) {
                // Validate mandatory fields
                if (!empty($row[1])) { // Assuming $row[1] is 'name'
                    // Prepare data for insertion
                    $data = [
                        'created_at' => now()->toDateTimeString(),
                        'name' => $row[1],
                        'age' => $row[2],
                        'country' => $row[3],
                        'type' => $row[4],
                        'certificate' => $row[5],
                        'main_field_id' => $row[6],
                        'sub_field_id' => $row[7],
                        'products' => $row[8],
                        'languages' => $row[9],
                        'wphone' => $row[10],
                        'vphone' => $row[11],
                        'email' => $row[12],
                        'cv' => $row[13],
                        'user_id' => $userId,
                        'new_franchise_id' => $new_franchise_id,
                    ];

                    // Insert data into database
                    DB::table('freelancers')->insert($data);
                } else {
                    // Log or handle the case where 'name' field is empty
                    // For example:
                    \Log::warning('Skipping row due to missing name field.');
                }
            }
        }
    }

    $notification = [
        'message' => 'تمت الاضافة بنجاح',
        'alert-type' => 'success'
    ];

    return redirect()->route('get_freelancer', app()->getLocale())->with($notification);
}
public function freelance_status($language ,$id)
{
//    dd($id);
    $freelance = RequestFreelancer::findOrFail($id);
    if($freelance)
    {
        $freelance->update(['freelancer_status' => 'يوجد']);
    }
    $notification = [
        'message' => 'تمت الاضافة بنجاح',
        'alert-type' => 'success'
    ];
    return redirect()->route('get_request_freelancer',app()->getLocale())->with($notification);

}





    // طلب مستقل

    public function request_freelancer(){
        $title = "request-freelancer";
        $description = "request-Freelancers";
        $mainfields = MainField::all();
        $subfields = SubField::all();
        return view('freelancers.request_freelancer' , compact("title" , "description" , "mainfields" , "subfields"));
    }

    public function store_request_freelancer(Request $request){

       $data = $request->validate([
            "main_field_id" => 'required',
            "sub_field_id" => 'required',
            "desc" => 'required',
            "status" => 'required',
           'freelancer_status' => 'required'
        ]);

        $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }

        RequestFreelancer::create($data);

        $notification = array(
            'message' => 'تمت الأضافة بنجاح',
            'alert-type' => 'success'
        );


        return redirect()->route('get_request_freelancer',app()->getLocale())->with($notification);

    }

    public function get_request_freelancer(){

        $title = "Freelancers";
        $description = "Freelancers";

        $requests_freelancers = RequestFreelancer::get();

        return view('freelancers.all_requests' , compact("title" , "description" , "requests_freelancers"));

    }

    public function edit_request_freelancer($language , $id){
        $title = "Edit Freelancer";
        $description = "Edit Freelancer";
        $mainfields = MainField::all();
        $subfields = SubField::all();

        $request_freelancer = RequestFreelancer::findOrFail($id);

        return view('freelancers.edit_request' , compact("title" , "description" , "request_freelancer" , "mainfields" , "subfields"));

    }

    public function update_request_freelancer(Request $request , $language ,$id){
        $title = "Update Freelancer";
        $description = "Update Freelancer";

        $data = $request->validate([
            "main_field_id" => 'required',
            "sub_field_id" => 'required',
            "desc" => 'required',
            "status" => 'required',
        ]);

                    $currentUser = Auth::user();
            if ($currentUser && $currentUser->new_franchise_id) {
                $data['new_franchise_id'] = $currentUser->new_franchise_id;
            }


        $request_freelancer = RequestFreelancer::findOrFail($id);


        $request_freelancer->update($data);

        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('get_request_freelancer',app()->getLocale())->with($notification);

    }


    public function delete_request_freelancer( $language , $id){

        // dd($id);

        $request_freelancer = RequestFreelancer::findOrFail($id);

        $request_freelancer->delete();

        $notification = array(
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        );

        // dd(app()->getLocale());
        return redirect()->route('get_request_freelancer' , app()->getLocale() )->with($notification);

    }








}
