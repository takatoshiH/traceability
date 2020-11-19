<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\str;

class ContentsController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        return view('index', compact('auth'));
    }

    public function add_content(Request $request)
    {
        $content = $request->session()->get('content');
        return view('content.add_content', compact('content'));
    }

    public function add_content_store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'name' => 'required|unique:contents',
            'price' => 'required|integer',
            'information' => 'required',
        ],
        [
            'brand.required' => 'ブランド名は必須です',
            'name.required' => '製品名は必須です',
            'name.unique' => 'その製品名はすでに使われてます。別の製品名を入力してください',
            'price.required' => '出荷価格は必須です',
            'price.integer' => '整数入力です',
            'information.required' => '製品詳細は必須です',
        ]);

        $imgdata = $request->except('imagefile');
        $content_file = $request->file('imagefile');

        if($request->hasFile('imagefile') && $content_file->isValid()){
            $image_path = $content_file->store('public');
            $read_image_path = str_replace('public/', 'storage/', $image_path);
        }

        $content = new Content;
        $validated = $request->validate([
            'brand' => 'required',
            'name' => 'required|unique:contents',
            'price' => 'required|integer',
            'information' => 'required',
        ],
        [
            'brand.required' => 'ブランド名は必須です',
            'name.required' => '製品名は必須です',
            'name.unique' => 'その製品名はすでに使われてます。別の製品名を入力してください',
            'price.required' => '出荷価格は必須です',
            'price.integer' => '整数入力です',
            'information.required' => '製品詳細は必須です',
        ]);
        $content->fill($validated);
        $content->user_id = $request->user()->id;
        $content->identifier = Str::random(10);
        $content->image_path = $read_image_path;
        $content -> save();
        $request->session()->put('content', $content);
        return redirect()->route('content.add_content_success');
    }

    public function add_content_success(Request $request)
    {
        $content = $request->session()->get('content');
        return view('index',compact('content'));
        // return view('content.add_content_success',compact('content'));
    }

    public function content_delete($id)
    {
        Content::where('id', $id)->delete();
        return redirect()->route('user_info');
    }

}