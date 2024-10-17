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
//        dd($user->new_franchise_id);
        $ManagementTeams = ManagementTeam::where('new_franchise_id',$user->new_franchise_id)->first();
        if(empty($ManagementTeams)){
            return view('managementTeam.create', compact('description','title','ManagementTeams'));

        }else {
            return view('managementTeam.edit', compact('description','title','ManagementTeams'));

        }
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'sales_manager' => 'required',
            'sales_manager_salary' => 'required',
            'technical_director' => 'required',
            'technical_director_salary' => 'required',
            'CFO' => 'required',
            'CFO_salary' => 'required',
            'CEO_salary' => 'required',
            'CEO' => 'required',
            'marketing_manager_salary'=> 'required',
            'marketing_manager'=> 'required',
            'hr_manager_salary' => 'required',
            'hr_manager' => 'required',
        ]);
        $data['sales_manager'] =intval( str_replace('%','',$data['sales_manager']));
        $data['technical_director'] =intval( str_replace('%','',$data['technical_director']));
        $data['CFO'] =intval( str_replace('%','',$data['CFO']));
        $data['CEO'] =intval( str_replace('%','',$data['CEO']));
        $data['hr_manager'] =intval( str_replace('%','',$data['hr_manager']));
        $data['marketing_manager'] =intval( str_replace('%','',$data['marketing_manager']));
        $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }


         ManagementTeam::create($data);

        $notification  = [
            'massage' => 'تم حفظ فريق الادارة بنجاح',
            'status' => 'success'
        ];
        return redirect()->route('managementTeam.add', app()->getLocale())->with($notification);


    }
    public function edit($id)
    {
        $managementTeam = ManagementTeam::findOrFail($id);
        return view('managementTeam.edit', compact('managementTeam'));
    }
    public function update(Request $request,$language, $id)
    {
        $data = $request->validate([
            'sales_manager' => 'required',
            'sales_manager_salary' => 'required',
            'technical_director' => 'required',
            'technical_director_salary' => 'required',
            'CFO' => 'required',
            'CFO_salary' => 'required',
            'CEO_salary' => 'required',
            'CEO' => 'required',
            'marketing_manager_salary'=> 'required',
            'marketing_manager'=> 'required',
            'hr_manager_salary' => 'required',
            'hr_manager' => 'required',
        ]);
        $data['sales_manager'] =intval( str_replace('%','',$data['sales_manager']));
        $data['technical_director'] =intval( str_replace('%','',$data['technical_director']));
        $data['CFO'] =intval( str_replace('%','',$data['CFO']));
        $data['CEO'] =intval( str_replace('%','',$data['CEO']));
        $data['hr_manager'] =intval( str_replace('%','',$data['hr_manager']));
        $data['marketing_manager'] =intval( str_replace('%','',$data['marketing_manager']));

        $currentUser = Auth::user();
        if ($currentUser && $currentUser->new_franchise_id) {
            $data['new_franchise_id'] = $currentUser->new_franchise_id;
        }
        $management_team = ManagementTeam::findOrFail($id);
        $management_team->update($data);
        if($management_team){
            $notification = [
                'massage' => 'تم تعديل فريق الادارة بنجاح',
                'status' => 'success'
            ];
            return redirect()->route('managementTeam.add', app()->getLocale())->with($notification);
        }
        $notification = [
            'massage' => 'حدث خطاء برجاء المحاولة ثانيا',
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

