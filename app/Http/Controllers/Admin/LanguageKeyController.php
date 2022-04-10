<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\App;
use App\Models\Language;
use App\Models\LanguageKey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ChecksPermission;
use Illuminate\Filesystem\Filesystem;

class LanguageKeyController extends Controller
{
    public function index(Filesystem $filesystem)
    {
        $locale = app()->getLocale();
        $path = resource_path('lang/'.$locale.'.json');
        return $existing = json_decode($filesystem->get($path));
        $all_data = Language::all();
        return view('admin.language.index', compact('all_data'));
    }

    public function create(Request $request)
    {
        return view('admin.languageKey.create',[
            'languages' => Language::select('key','name')->where('status', 1)->get(),
            'keys' => $request->filled('locale') ? LanguageKey::all() : []
        ]);
    }

    public function store(Request $request, Filesystem $filesystem)
    {
        $validated = $request->validate([
            'locale' => [
                'required', 
                \Illuminate\Validation\Rule::in(Language::pluck('key'))
            ],
            'values' => 'required|array'
        ]);

        $path = resource_path('lang/'.$validated['locale'].'.json');
        $existing = json_decode($filesystem->get($path), true);

        if ($filesystem->put($path, json_encode((object) array_merge($existing, $validated['values']), JSON_PRETTY_PRINT))) {
            session()->flash('success', 'Language Updated Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // 
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
