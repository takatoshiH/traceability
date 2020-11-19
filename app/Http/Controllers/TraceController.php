<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Trace;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TraceController extends Controller
{
    public function content_detail(Request $request)
    {
        $request->validate([
            'search' => 'required|max:10',
        ]);

        $content = Content::where('identifier', $request->input('search'))->first();
        
        if($content === null) {
            return redirect()->route('index')->with('identifier_error', '入力した商品は登録されていません');
        } else {
            $user = Auth::user();
            $dateTime = Carbon::now();
            $traces = Trace::where('content_id', $content->id)->orderBy('created_at', 'desc')->get();
            return view ('trace.content_detail', compact('user', 'dateTime', 'content', 'traces')); 
        }
        

    }

    public function content_detail_store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ],
        [
            'comment.required' => 'コメントを入力してください',
            'latitude.required' => '緯度は必須です',
            'longitude.required' => '経度は必須です',
        ]);

        $trace = new Trace;
        $validated = $request->validate([
            'comment' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ],
        [
            'comment.required' => 'コメントを入力してください',
            'latitude.required' => '緯度は必須です',
            'longitude.required' => '経度は必須です',
        ]);
        $trace->fill($validated);
        $trace->user_id = $request->user_id;
        $trace->content_id = $request->content_id;
        $trace->save();
        return redirect()->route('content_detail');
    }

    public function comment_detail()
    {
        $auth = Auth::user();
        $dateTime = Carbon::now();
        return view ('trace.comment_detail', compact('auth', 'dateTime'));
    }

    public function comment_detail_update()
    {
        
    }
}
