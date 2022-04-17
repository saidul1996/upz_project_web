<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminDetail;
use App\Models\Admin;
use App\Models\District;
use App\Models\Union;
use App\Models\Upazilla;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Traits\ChecksPermission;

class ChairmanAdminController extends Controller
{
    use ChecksPermission;
    protected string $permissionPrefix = 'chairmanAdmin';

    public function index()
    {
        return view('admin.chairmanAdmin.index', [
            'all_data' => AdminDetail::where('roll', 6)->get()
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
        return view('admin.chairmanAdmin.show', compact('data'));
    }

    public function edit($id)
    {
        $data = AdminDetail::find($id);
        return view('admin.chairmanAdmin.edit', compact('data'));
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
            DB::table('role_user')->where('user_id', $admin->id)->delete();
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
            session()->flash('success', 'Chairman Info Updated Successfully');
            return redirect()->route('admin.chairmanAdmin.index');
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return redirect()->route('admin.chairmanAdmin.index');
        }
    }

    public function destroy($id)
    {
        $adminDetail = AdminDetail::find($id);

        if( $count = User::where('union_id', $adminDetail->union_id)->count()){
            session()->flash('error', $count.' Users Has Under This Chairman!');
            return back();
        }
        else{
            if(Admin::where('id', $adminDetail->admin_id)->delete() AND $adminDetail->delete()){
                session()->flash('success', 'Chairman Deleted Successfully');
                return back();
            }
            else{
                session()->flash('error', 'Somethin Went Wrong');
                return back();
            }
        }
    }
}
