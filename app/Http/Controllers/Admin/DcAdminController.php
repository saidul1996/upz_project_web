<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminDetail;
use App\Models\Admin;
use App\Models\District;
use App\Models\Upazilla;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Lib\Image;
use App\Traits\ChecksPermission;

class DcAdminController extends Controller
{
    use ChecksPermission;
    protected string $permissionPrefix = 'dcAdmin';

    public function index()
    {
        return view('admin.dcAdmin.index', [
            'all_data' => AdminDetail::where('roll', 3)->get()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $data = AdminDetail::find($id);
        return view('admin.dcAdmin.show', compact('data'));
    }

    public function edit($id)
    {
        $data = AdminDetail::find($id);
        return view('admin.dcAdmin.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $adminDetail = AdminDetail::find($id);

        $request->validate([
            'name'          => 'required',
            'phone'         => 'required|min:11|max:11',
            'email'         => 'required|email',
            'address'       => 'required',
            'nid_no'        => 'required',
            'date_of_birth' => 'required',
            'gender'        => 'required',
        ]);

        $admin = Admin::find($adminDetail->admin_id);

        if($request->status==1){
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            $admin->status = 1;
            $admin->created_at = Carbon::now();
            $admin->save();
        }
        else{
            $admin->delete();
        }

        $adminDetail->name = $request->name;
        $adminDetail->phone = $request->phone;
        $adminDetail->email = $request->email;
        $adminDetail->address = $request->address;
        $adminDetail->nid_no = $request->nid_no;
        $adminDetail->date_of_birth = $request->date_of_birth;
        $adminDetail->gender = $request->gender;
        $adminDetail->password = Hash::make($request->password);
        $adminDetail->status = $request->status;
        $adminDetail->added_by = Auth::id();
        $adminDetail->updated_at = Carbon::now();
        if($adminDetail->save()){
            session()->flash('success', 'AdminDetail Updated Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function destroy($id)
    {
        $adminDetail = AdminDetail::find($id);

        if( $count = AdminDetail::whereIn('upazilla_id', Upazilla::where('district_id', $adminDetail->district_id)->pluck('id'))->count()){
            session()->flash('error', $count.' UNO Has Under This DC!');
            return back();
        }
        else{
            if(Admin::where('id', $adminDetail->admin_id)->delete() AND $adminDetail->delete()){
                session()->flash('success', 'DC Deleted Successfully');
                return back();
            }
            else{
                session()->flash('error', 'Somethin Went Wrong');
                return back();
            }
        }
    }
}
