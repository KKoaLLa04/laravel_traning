<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    //
    public function index()
    {
        $post = new Post;

        $title = 'Danh sách bài viết';
        $allData = $post->withTrashed()->get();

        return view('clients.posts.lists', compact('title', 'allData'));
    }

    public function handleDelete(Request $request)
    {
        if (!empty($request->delete)) {
            $deleteArr = $request->delete;

            $status = Post::destroy($deleteArr);

            if (!empty($status)) {
                $msg = 'Xóa ' . count($deleteArr) . ' tiêu đề thành công';
            } else {
                $msg = 'Hiện không thể xóa, vui lòng thử lại sau!';
            }
        } else {
            $msg = 'Vui lòng chọn tiêu đề muốn xóa';
        }

        return redirect()->route('posts.index')->with('msg', $msg);
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        if (!empty($post)) {
            $post->restore();

            return redirect()->route('posts.index')->with('msg', 'Khôi phục bài viết thành công');
        }
        return redirect()->route('posts.index')->with('msg', 'Có lỗi xảy ra, thử lại sau');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        if (!empty($post)) {
            $post->forceDelete();

            return redirect()->route('posts.index')->with('msg', 'Xóa bài viết thành công');
        }
        return redirect()->route('posts.index')->with('msg', 'Có lỗi xảy ra, thử lại sau');
    }
}
