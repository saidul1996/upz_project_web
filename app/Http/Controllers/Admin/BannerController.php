<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Lib\Image;
use App\Traits\ChecksPermission;

class BannerController extends Controller
{
    use ChecksPermission;
    protected string $permissionPrefix = 'banner';

    public function index()
    {
        $all_data = Banner::all();
        return view('admin.banner.index', compact('all_data'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        $insert_row = new Banner;
        $insert_row->banner_title = $request->banner_title;
        $insert_row->image = Image::store("image","upload/banner");
        $insert_row->added_by = Auth::id();
        $insert_row->created_at = Carbon::now();

        if($insert_row->save()){
            session()->flash('success', 'Banner Created Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function show(Banner $banner)
    {
        return view('admin.banner.show', compact('banner'));
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:1024'
        ]);

        if(!empty($request->image)){
            Image::delete($banner->image);
            $banner->image = Image::store("image","upload/banner");
            $updated_row = $banner->save();
        }

        $banner->banner_title = $request->banner_title;
        $banner->added_by = Auth::id();
        $banner->updated_at = Carbon::now();
        $updated_row = $banner->save();

        if($updated_row){
            session()->flash('success', 'Banner Updated Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }

    }

    public function destroy(Banner $banner)
    {
        Image::delete($banner->image);
        if($banner->delete()){
            session()->flash('success', 'Banner Deleted Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }
}
