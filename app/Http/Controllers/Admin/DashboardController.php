<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        /*
         * Uncomment the line below if you want to use verified middleware
         */
        //$this->middleware('verified:admin.verification.notice');
    }

    public function index()
    {
        $user['date_row'] = User::select(DB::raw('DATE(created_at) AS date'), DB::raw('count(*) as count_row'))->groupBy('date')->take(7)->pluck('count_row')->join(',');
        $user['total'] = User::where('status', 0)->count();
        $user['today'] = User::whereDate('created_at', Carbon::today())->count();
        $user['last_month'] = User::where('created_at', '>=', Carbon::now()->firstOfMonth()->toDateTimeString())->count();

        return view('admin.home.index' ,compact('user'));
    }

}
