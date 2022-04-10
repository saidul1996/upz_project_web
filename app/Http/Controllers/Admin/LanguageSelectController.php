<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageSelectController extends Controller
{
    public function languageSelect()
    {
        return view('admin.language.select',[
            'languages' => Language::where('status', 1)->get()
        ]);
    }

    public function languageSelection(Request $request)
    {
        \Cache::put('locale', $request->locale);
        if (\Cache::get('locale', 'en')==$request->locale) {
            session()->flash('success', 'Language Set Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }
}
