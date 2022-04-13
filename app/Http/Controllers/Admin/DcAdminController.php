<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
        return view('admin.adminDetail.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:languages',
            'phone' => 'required|min:11|max:11',
            'image' => 'image|mimes:jpeg,png,jpg|max:1024'
        ]);

        $insert_row = new AdminDetail;
        $insert_row->name = $request->name;
        if(!empty($request->image)){
            $insert_row->image = Image::store("image","upload/adminDetail");
        }
        $insert_row->added_by = Auth::id();
        $insert_row->created_at = Carbon::now();
        if($insert_row->save()){
            session()->flash('success', 'AdminDetail Created Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function show(AdminDetail $adminDetail)
    {
        return view('admin.adminDetail.show', compact('adminDetail'));
    }

    public function edit(AdminDetail $adminDetail)
    {
        return view('admin.adminDetail.edit', compact('adminDetail'));
    }

    public function update(Request $request, AdminDetail $adminDetail)
    {
        $request->validate([
            'name'  => 'required|unique:languages',
            'phone' => 'required|min:11|max:11',
            'image' => 'image|mimes:jpeg,png,jpg|max:1024'
        ]);

        $adminDetail->name = $request->name;
        $adminDetail->phone = $request->phone;
        if(!empty($request->image)){
            Image::delete($adminDetail->image);
            $insert_row->image = Image::store("image","upload/adminDetail");
        }
        $adminDetail->added_by = Auth::id();
        $adminDetail->updated_at = Carbon::now();
        if($adminDetail->save()){
            session()->flash('success', 'AdminDetail Created Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function destroy(AdminDetail $adminDetail)
    {
        if($adminDetail->image){
            Image::delete($adminDetail->image);
        }
        if($adminDetail->delete()){
            session()->flash('success', 'AdminDetail Deleted Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }
}
