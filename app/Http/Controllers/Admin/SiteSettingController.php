<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Lib\Image;
use Carbon\Carbon;
use App\Traits\ChecksPermission;

class SiteSettingController extends Controller
{
    use ChecksPermission;
    protected string $permissionPrefix = 'siteSetting';

    public function index()
    {
        return view('admin.siteSetting.index', [
            'data' => SiteSetting::first()
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

    public function show(SiteSetting $siteSetting)
    {
        //
    }

    public function edit(SiteSetting $siteSetting)
    {
        return view('admin.siteSetting.edit', compact('siteSetting'));
    }

    public function update(Request $request, SiteSetting $siteSetting)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'phone'   => 'required|min:11|max:11',
            'website' => 'required',
            'address' => 'required',
            'logo'    => 'image|mimes:jpeg,png,jpg|max:1024'
        ]);

        $siteSetting->name = $request->name;
        $siteSetting->email = $request->email;
        $siteSetting->phone = $request->phone;
        $siteSetting->website = $request->website;
        $siteSetting->address = $request->address;
        $siteSetting->updated_at = Carbon::now();
        $updated = $siteSetting->save();

        if(!empty($request->logo)){
            $siteSetting->logo = Image::store("logo","upload/siteSetting/logo");
            $siteSetting->save();
        }

        if(isset($updated)){
            session()->flash('success', 'SiteSetting Updated Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function destroy(SiteSetting $siteSetting)
    {
        //
    }
}
