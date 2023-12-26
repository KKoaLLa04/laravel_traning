@extends('layouts/admin')

@section('content')
    <h1 class="text-center">Danh sách bài viết</h1>
    @can('create', app\Models\Posts::class)
    <p><a href="{{route('admin.posts.add')}}" class="btn btn-primary">Thêm bài viết mới</a></p>
    @endcan
    @if(session('msg'))
    <div class="alert alert-success">
        {{session('msg')}}
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Tiêu đề</th>
                <th width="15%">Người đăng</th>
                @can('posts.edit')
                <th width="5%">Sửa</th>
                @endcan
                @can('posts.delete')
                <th width="5%">Xóa</th>
                @endcan
            </tr>
        </thead>
        
        <tbody>
            @if(!empty($lists))
                @foreach($lists as $key => $item)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->title}}</td>
                <td>{{!empty($item->postBy->name)? $item->postBy->name :false}}</td>
                @can('posts.edit')
                <td><a href="{{route('admin.posts.edit', $item->id)}}" class="btn btn-warning">Sửa</a></td>
                @endcan
                @can('posts.delete')
                <td>
                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.posts.delete', $item->id)}}" class="btn btn-danger">Xóa</a>
                </td>
                @endcan
            </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection