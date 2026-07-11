<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::pluck('value', 'key');
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = $request->except('_token');
        
        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        \Illuminate\Support\Facades\Cache::forget('site_settings');

        return redirect()->route('admin.settings.edit')->with('success', 'Site settings updated successfully.');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/content'), $filename);
            
            return response()->json([
                'location' => '/uploads/content/' . $filename
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
