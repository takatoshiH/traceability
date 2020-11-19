<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Content;
use App\Models\Trace;
use Auth;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function users_list()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users_list', compact('users'));
    }

    public function users_show($id)
    {
        $user = User::find($id);
        return view('user_info', compact('user'));
    }

    public function contents_list()
    {
        $contents = Content::orderBy('created_at', 'desc')->get();
        return view('admin.contents_list', compact('contents'));
    }

    public function contents_show($id)
    {
        $content = Content::find($id);
        $dateTime = Carbon::now();
        $user = Auth::user();
        $traces = Trace::where('content_id', $content->id)->orderBy('created_at', 'desc')->get();
        return view('trace.content_detail', compact('traces', 'content', 'dateTime', 'user'));
    }
}
