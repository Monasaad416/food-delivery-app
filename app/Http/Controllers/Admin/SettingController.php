<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::firstOrCreate();
        return view('dashboard.pages.settings.edit',['settings'=>$settings]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'email'=> 'nullable|email',
            'about_us'=> 'nullable|string',
            'app_commissions'=> 'nullable|numeric',
            'commission_text'=> 'nullable|string',
            ]);

        $settings = Setting::first();
        $settings->update($request->all());
        $settings->save();

        $request->session()->flash("update");
       return redirect()->route('settings.edit');
    }
}
