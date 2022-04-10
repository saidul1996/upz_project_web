<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Traits\ChecksPermission;
use Illuminate\Filesystem\Filesystem;

class LanguageController extends Controller
{
    use ChecksPermission;
    protected string $permissionPrefix = 'language';

    public function index()
    {
        $all_data = Language::all();
        return view('admin.language.index', compact('all_data'));
    }

    public function create()
    {
        return view('admin.language.create');
    }

    public function store(Request $request, Filesystem $filesystem)
    {
        $request->validate([
            'key' => 'required|unique:languages',
            'name' => 'required|unique:languages'
        ]);

        $insert_row_id = Language::insertGetId([
            'key' => $request->key,
            'name' => $request->name,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        $path = resource_path('lang/'.$request->key.'.json');

        if($filesystem->put($path, json_encode((object)[], JSON_PRETTY_PRINT))) {
            session()->flash('success', 'Language Created Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function show(Language $language)
    {
        return view('admin.language.show', compact('language'));
    }

    public function edit(Language $language)
    {
        return view('admin.language.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'key' => ['required', \Illuminate\Validation\Rule::unique('languages','key')->ignore($language->id)],
            'name' => ['required', \Illuminate\Validation\Rule::unique('languages','name')->ignore($language->id)],
        ]);

        $language->key = $request->key;
        $language->name = $request->name;
        $language->status = $request->status;
        $language->added_by = Auth::id();
        $language->updated_at = Carbon::now();
        $update_row = $language->save();

        if(isset($update_row)){
            session()->flash('success', 'Language Updated Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function destroy(Language $language)
    {
        $delete_row = $language->delete();
        if(isset($delete_row)){
            session()->flash('success', 'Language Deleted Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function writeNewString(Request $request, Filesystem $filesystem)
    {
        $validated = $request->validate([
            'locale' => [
                'required', 
                \Illuminate\Validation\Rule::in(Language::pluck('key'))
            ],
            'key' => 'required',
            'value' => 'required'
        ]);

        $path = resource_path('lang/'.$validated['locale'].'.json');
        $existing = json_decode($filesystem->get($path));
        $existing[$validated['key']] = $validated['value'];

        if ($filesystem->put(json_encode((object) $existing, JSON_PRETTY_PRINT))) {
            session()->flash('success', 'Language Updated Successfully');
            return back();
        }
        session()->flash('error', 'Somethin Went Wrong');
        return back();
    }
}
