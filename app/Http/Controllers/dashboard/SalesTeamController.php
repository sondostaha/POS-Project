<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\SalesTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesTeamController extends Controller
{
    public function index()
    {
        $SalesTeams = SalesTeam::get();
        $title = "Sales Team";
        $description = "Sales Team";
        return view('SalesTeam.all', compact('title','description','SalesTeams'));
    }
    public function create()
    {
        $title = "Sales Team";
        $description = "Sales Team";
        $currentUser = Auth::user();
        $SalesTeams = SalesTeam::where('new_franchise_id',$currentUser->new_franchise_id)->first();
        return view('SalesTeam.create', compact('description','title','SalesTeams'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'sales_agent' => 'required',
            'sales_officer' => 'required',

        ]);
        $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }
        $SalesTeam = SalesTeam::where('new_franchise_id',$currentUser->new_franchise_id)->first();
        if(!empty($SalesTeam))
        {
            $this->update($request, $SalesTeam->id);
        }
        else {


            SalesTeam::create($data);
        }
        $notification  = [
            'massage' => 'تم حفظ فريق المبيعات بنجاح',
            'status' => 'success'
        ];
        return redirect()->route('SalesTeam.add', app()->getLocale())->with($notification);


    }
    public function edit($id)
    {
        $SalesTeam = SalesTeam::findOrFail($id);
        return view('SalesTeam.edit', compact('SalesTeam'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'sales_agent' => 'required',
            'sales_officer' => 'required',

        ]);
        $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }
        $sales_team = SalesTeam::findOrFail($id);
        $sales_team->update($data);
        if($sales_team){
            $notification = [
                'massage' => 'تم تعديل فريق المبيعات بنجاح',
                'status' => 'success'
            ];
            return redirect()->route('SalesTeam.add', app()->getLocale())->with($notification);
        }
        $notification = [
            'massage' => 'حدث خطاء برجاء المحاوله ثانيا',
            'status' => 'error'
        ];
        return redirect()->route('SalesTeam.add', app()->getLocale())->with($notification);
    }
    public function destroy($id)
    {
        $sales_team = SalesTeam::findOrFail($id);
        $sales_team->delete();
        $notification = [
            'massage' => 'تم الحذف  بنجاح',
            'status' => 'success'
        ];
        return redirect()->route('SalesTeam.add', app()->getLocale())->with($notification);
    }
}
