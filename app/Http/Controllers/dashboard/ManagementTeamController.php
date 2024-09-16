<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ManagementTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementTeamController extends Controller
{
    public function index()
    {
        $managementTeams = ManagementTeam::get();
        $title = "Manage Team";
        $description = "Manage Team";
        return view('managementTeam.all', compact('title','description','managementTeams'));
    }
    public function create()
    {
        $title = "Manage Team";
        $description = "Manage Team";
        $user =  Auth::user();
        $ManagementTeams = ManagementTeam::where('new_franchise_id',$user->new_franchise_id)->first();
        return view('managementTeam.create', compact('description','title','ManagementTeams'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'sales_manager' => 'required',
            'technical_director' => 'required',
            'CFO' => 'required',
            'CEO' => 'required',
            'hr_manager' => 'required',
                ]);
        $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }
        $managementTeam = ManagementTeam::where('new_franchise_id',$currentUser->new_franchise_id)->first();
        if(!empty($managementTeam))
        {
            $this->update($request, $managementTeam->id);
        }
        else {


            ManagementTeam::create($data);
        }
        $notification  = [
            'massage' => 'تم حفظ فريق الاداره بنجاح',
            'status' => 'success'
        ];
        return redirect()->route('managementTeam.add', app()->getLocale())->with($notification);


    }
    public function edit($id)
    {
        $managementTeam = ManagementTeam::findOrFail($id);
        return view('managementTeam.edit', compact('managementTeam'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'sales_manager' => 'required',
            'technical_director' => 'required',
            'CFO' => 'required',
            'CEO' => 'required',
            'hr_manager' => 'required',
        ]);
        $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }
        $management_team = ManagementTeam::findOrFail($id);
        $management_team->update($data);
        if($management_team){
            $notification = [
                'massage' => 'تم تعديل فريق الاداره بنجاح',
                'status' => 'success'
            ];
            return redirect()->route('managementTeam.add', app()->getLocale())->with($notification);
        }
        $notification = [
            'massage' => 'حدث خطاء برجاء المحاوله ثانيا',
            'status' => 'error'
        ];
        return redirect()->route('managementTeam.add', app()->getLocale())->with($notification);
    }
    public function destroy($id)
    {
        $management_team = ManagementTeam::findOrFail($id);
        $management_team->delete();
        $notification = [
            'massage' => 'تم الحذف  بنجاح',
            'status' => 'success'
        ];
        return redirect()->route('managementTeam.add', app()->getLocale())->with($notification);
    }
}

