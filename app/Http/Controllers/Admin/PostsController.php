<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $lists = Posts::orderBy('created_at', 'desc')->where('user_id', $userId)->get();
        return view('admin.posts.lists', compact('lists'));
    }

    public function add()
    {
        return view('admin.posts.add');
    }

    public function postAdd(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required',
            ],
            [
                'title.required' => 'Nhóm người dùng bắt buộc phải nhập',
                'title.unique' => 'Nhóm người dùng đã tồn tại',
                'content.required' => 'Nội dung không được để trống'
            ]
        );

        $post = new Posts();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->created_at = date('Y-m-d H:i:s');
        $post->save();

        return redirect()->route('admin.posts.index')->with('msg', 'Thêm bài viết mới thành công!');
    }

    public function edit(Posts $post)
    {
        $this->authorize('update', $post);
        return view('admin.posts.edit', compact('post'));
    }

    public function postEdit(Posts $post, Request $request)
    {
        $this->authorize('update', $post);
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required',
            ],
            [
                'title.required' => 'Nhóm người dùng bắt buộc phải nhập',
                'content.required' => 'Nội dung bắt buộc phải nhập,'
            ]
        );

        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->save();

        return back()->with('msg', 'Cập nhật bài viết thành công!');
    }

    public function delete(Posts $post)
    {
        $this->authorize('delete', $post);
        Posts::destroy($post->id);
        return redirect()->route('admin.posts.index')->with('msg', 'Xóa bài viết thành công!');
    }
}
