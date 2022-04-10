<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\ChecksPermission;

class AdminController extends Controller
{
    use ChecksPermission;
    protected string $permissionPrefix = 'admin';

    public function index()
    {
        $all_data = Admin::all();
        return view('admin.admin.index', compact('all_data'));
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'email'       => 'unique:users',
            'password'    => 'required',
        ]);

        $insert_row_id = Admin::insertGetId([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        if(isset($insert_row_id)){
            session()->flash('success', 'Admin Created Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function show(Admin $admin)
    {
        return view('admin.admin.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('admin.admin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'        => 'required',
            'email'       => [\Illuminate\Validation\Rule::unique('users')->ignore($admin->id)],
        ]);

        if(isset($request->password)){
            $admin->password   = Hash::make($request->password);
        }
        $admin->name        = $request->name;
        $admin->email       = $request->email;
        $admin->updated_at  = Carbon::now();
        $update_row = $admin->save();

        if(isset($update_row)){
            session()->flash('success', 'Admin Updated Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function destroy(Admin $admin)
    {
        $delete_row = $admin->delete();
        if(isset($delete_row)){
            session()->flash('success', 'Admin Deleted Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }
}
