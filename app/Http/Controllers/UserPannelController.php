<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class UserPannelController extends Controller
{
    public function userDashboard()
    {
        $product['date_row'] = Product::select(DB::raw('DATE(created_at) AS date'), DB::raw('count(*) as count_row'))->groupBy('date')->take(7)->pluck('count_row')->join(',');
        $product['total'] = Product::where('status', 0)->count();
        $product['today'] = Product::where('status', 0)->whereDate('created_at', Carbon::today())->count();
        $product['last_month'] = Product::where('status', 0)->where('created_at', '>=', Carbon::now()->firstOfMonth()->toDateTimeString())->count();

        $requisition['date_row'] = Requisition::where('user_id', Auth::id())->select(DB::raw('DATE(created_at) AS date'), DB::raw('count(*) as count_row'))->groupBy('date')->take(7)->pluck('count_row')->join(',');
        $requisition['total'] = Requisition::where('user_id', Auth::id())->count();
        $requisition['pending'] = Requisition::where('user_id', Auth::id())->whereIn('status', [1,2])->count();
        $requisition['approved'] = Requisition::where('user_id', Auth::id())->where('status', 3)->count();

        $stock['date_row'] = Stockout::where('user_id', Auth::id())->select(DB::raw('DATE(created_at) AS date'), DB::raw('count(*) as count_row'))->groupBy('date')->take(7)->pluck('count_row')->join(',');
        $stock['total'] = Stockout::where('user_id', Auth::id())->count();
        $stock['pending'] = Stockout::where('user_id', Auth::id())->where('status', 1)->count();
        $stock['approved'] = Stockout::where('user_id', Auth::id())->where('status', 2)->count();

        return view('dashboard', compact('product','requisition','stock'));
    }

    public function userProfile()
    {
        $user = User::find(Auth()->id());
        return view('user.profile.show', compact('user'));
    }

    public function userProfileEdit()
    {
        $user = User::find(Auth()->id());
        return view('user.profile.edit', compact('user'));
    }

    public function userProfileUpdate(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required',
            'address' => 'required'
        ]);

        $user = User::find($id);
        $user->name    = $request->name;
        $user->address = $request->address;
        $update_row = $user->save();

        if(isset($update_row)){
            session()->flash('success', 'Profile Updated Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function userPasswordUpdate(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required'
        ]);

        if(Hash::check($request->old_password, Auth::user()->password)){
            $user = User::find($id);
            $user->password = Hash::make($request->new_password);
            $user->save();
            session()->flash('success', 'Password Updated Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Your Old Password Does Not Match');
            return back();
        }
    }
}
