<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AdminDetail;
use App\Models\Admin;
use Carbon\Carbon;

class CommonController extends Controller
{
    public function adminApprove($id)
    {
        $dcAdmin = AdminDetail::find($id);

        $admin = new Admin;
        $admin->name = $dcAdmin->name;
        $admin->email = $dcAdmin->email;
        $admin->roll = $dcAdmin->roll;
        $admin->password = $dcAdmin->password;
        $admin->status = 1;
        $admin->created_at = Carbon::now();
        $admin->save();

        DB::table('role_user')->insert([
            "role_id"   => $dcAdmin->roll,
            "user_id"   => $admin->id,
            "user_type" => 'App\Models\Admin',
        ]);

        $dcAdmin->admin_id = $admin->id;
        $dcAdmin->status = 1;

        if($dcAdmin->save()){
            session()->flash('success', 'DC Admin Successfully Apporoved');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }

    }

    public function adminReject($id)
    {
        if(AdminDetail::where('id', $id)->delete()){
            session()->flash('success', 'DC Admin Rejected Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }
}
