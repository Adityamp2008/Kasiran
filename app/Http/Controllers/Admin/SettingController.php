<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        return view('pages.admin.setting');
    }

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password'     => 'required|min:6|confirmed',
    ]);

    // cek password lama
    if (!Hash::check($request->current_password, Auth::user()->password)) {
        return back()->withErrors(['current_password' => 'Password lama salah']);
    }

    // ambil user dari model
    $user = User::find(Auth::id());

    // update password
    $user->update([
        'password' => $request->new_password,
    ]);

    return back()->with('success', 'Password berhasil diperbarui');
}
}
