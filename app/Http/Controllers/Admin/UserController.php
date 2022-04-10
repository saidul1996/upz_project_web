<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\ChecksPermission;

class UserController extends Controller
{
    use ChecksPermission;
    protected string $permissionPrefix = 'user';

    public function index()
    {
        $all_data = User::all();
        return view('admin.user.index', compact('all_data'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'email'       => 'unique:users',
            'phone'       => 'required|unique:users',
            'password'    => 'required',
            'designation' => 'required',
        ]);

        $insert_row_id = User::insertGetId([
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => Hash::make($request->password),
            'designation' => $request->designation,
            'depertment' => $request->depertment,
            'address'    => $request->address,
            'api_token'  => Str::random(80),
            'added_by'   => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        if(isset($insert_row_id)){
            session()->flash('success', 'User Created Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'        => 'required',
            'email'       => [\Illuminate\Validation\Rule::unique('users')->ignore($user->id)],
            'phone'       => ['required', \Illuminate\Validation\Rule::unique('users')->ignore($user->id)],
            'designation' => 'required',
        ]);

        if(isset($request->password)){
            $user->password   = Hash::make($request->password);
        }
        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->phone       = $request->phone;
        $user->designation = $request->designation;
        $user->depertment  = $request->depertment;
        $user->address     = $request->address;
        $user->status      = $request->status;
        $user->added_by    = Auth::id();
        $user->updated_at  = Carbon::now();
        $update_row = $user->save();

        if(isset($update_row)){
            session()->flash('success', 'User Updated Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function destroy(User $user)
    {
        $delete_row = $user->delete();
        if(isset($delete_row)){
            session()->flash('success', 'User Deleted Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }
}
