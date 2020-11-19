<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\str;

class UserController extends Controller
{
    public function user_info()
    {
        $user = Auth::user();
        $contents = Content::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('user_info', compact('user', 'contents'));
    }

    public function user_info_edit()
    {
        $user = Auth::user();
        return view('user_info_edit', compact('user'));
    }

    public function user_updete(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('user_info_edit_success');
    }

    public function user_info_edit_success()
    {
        return view('user_info_edit_success');
    }

    public function user_logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
