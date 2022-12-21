<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    
    public function profile()
    {
        $loggedAdmin = auth()->user();
        return view('dashboard.pages.profile.edit',['loggedAdmin'=>$loggedAdmin]);
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'=> 'nullable|string',
            'email' => [Rule::unique('users')->ignore($request->user()->id)],
            'password' => 'nullable|string|min:5|max:25|confirmed',
        ]);
        $loggedAdmin = $request->user();
        $loggedAdmin->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if($request->has('password')){
            $newPassword = Hash::make($request->password);
            $loggedAdmin->update(['password'=>$newPassword]);
        };

        $request->session()->flash("update");
        return  view('dashboard.pages.profile.edit',['loggedAdmin'=>$loggedAdmin]);
    }

}
