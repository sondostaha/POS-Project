<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Country;
use App\Models\Franchise;
use App\Models\MainField;
use App\Models\NewFranchise;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TransferData;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ClientController extends Controller
{
    public function add(){
        $title = "Add Client";
        $description = "Add Client";
        $currentUser = Auth::user();

        $countries = Country::all();
        $sellers = User::whereHas('roles', function ($query) {
            $query->where('name', 'وكيل مبيعات');
        })->where('new_franchise_id' , $currentUser->new_franchise_id)->get();
        $main_fields = MainField::where('new_franchise_id' , $currentUser->new_franchise_id)->get();
        return view('clients.add' , compact("title" , "description" , "countries" ,"sellers" , "main_fields"));
    }

    public function all(){
        $title = "Clients";
        $description = "Clients";
        $currentUser = Auth::user();
        $clients = Client::where('new_franchise_id' , $currentUser->new_franchise_id)->with('user')->get();

        return view('clients.all' , compact("title" , "description" , "clients"));
    }

    public function store(Request $request){
        $data = $request->validate([
            "name" => 'required',
            "email" => 'required|email|unique:clients,email',
            "phone" => 'required',
            "country" => 'required',
            "gender" => 'required',
            "what" => 'required',
            "source" => 'required',
            "important" => 'required',
            "notes" => 'string|nullable',
            "user_id" => 'required',
            "main_field_id" => 'required',
        ]);


        $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }

        Client::create($data);

        $notification = array(
            'message' => 'تمت الأضافة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_clients',app()->getLocale())->with($notification);

    }


    public function edit($language , $id){
        $title = "Edit Clients";
        $description = "Edit Clients";
        $client = Client::findOrFail($id);
        $currentUser = Auth::user();

        $countries = Country::all();
        $sellers = User::whereHas('roles', function ($query) {
            $query->where('name', 'وكيل مبيعات');
        })->where('new_franchise_id' , $currentUser->new_franchise_id)->get();
        $main_fields = MainField::where('new_franchise_id' , $currentUser->new_franchise_id)->get();

        return view('clients.edit' , compact("title" , "description" , "client" , "countries" ,"sellers" , "main_fields" ));

    }

    public function update(Request $request , $language , $id ){
        $data = $request->validate([
            "name" => 'required',
            "email" => 'required|email',
            "phone" => 'required',
            "country" => 'required',
            "gender" => 'required',
            "what" => 'required',
            "source" => 'required',
            "important" => 'required',
            "notes" => 'string|nullable',
            "user_id" => 'required',
            "main_field_id" => 'required',
        ]);

        $client = Client::findOrFail($id);

                $currentUser = Auth::user();
            if ($currentUser && $currentUser->new_franchise_id) {
                $data['new_franchise_id'] = $currentUser->new_franchise_id;
            }

        $client->update($data);


        $notification = array(
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_clients',app()->getLocale())->with($notification);


    }

    public function delete($language , $id){

        $client = Client::findOrFail($id);

        $client->delete();

        $notification = array(
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all_clients',app()->getLocale())->with($notification);


    }




  public function create_transfer()
    {
        $clients = Client::all();
        $title = "transfers";
        $description = "transfers";
        return view('transfer_data.create', compact('clients' , 'description','title'));
    }

        public function transfer_index()
    {
        $clients = Client::with('transfers')->get();
                $currentUser = Auth::user();
        $clients = Client::with('transfers')->where('new_franchise_id' , $currentUser->new_franchise_id)->get();
        $title = "transfers";
        $description = "transfers";
        return view('transfer_data.index', compact('clients', 'description','title'));
    }

public function store_transfer(Request $request)
{
    $data = $request->validate([
        'client_id' => 'required|exists:clients,id',
        'file' => 'required|mimes:pdf|max:10000'
    ]);

    $currentUser = Auth::user();
    if ($currentUser && $currentUser->new_franchise_id) {
        $data['new_franchise_id'] = $currentUser->new_franchise_id;
    }

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('uploads/transfers');

        // Create directory if not exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $file->move($destinationPath, $fileName);
        $filePath = 'uploads/transfers/' . $fileName;

        TransferData::create([
            'client_id' => $data['client_id'],
            'file_path' => $filePath,
            'new_franchise_id' => $data['new_franchise_id'] ?? null
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    return redirect()->back()->with('error', 'No file was uploaded.');
}




public function download($language , $id)
{
    $transfer = TransferData::findOrFail($id);
    $filePath = public_path($transfer->file_path);

    if (!file_exists($filePath)) {
        abort(404, 'File not found');
    }

    $fileName = basename($transfer->file_path);

    return response()->download($filePath, $fileName);
}








}
