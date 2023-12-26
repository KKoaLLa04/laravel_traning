@extends('layouts/admin')

@section('content')
    <h1 class="text-center">Cập nhật bài viết</h1>
    <p><a href="{{route('admin.posts.index')}}" class="btn btn-primary">Quay lại</a></p>
    @if($errors->any())
        <div class="alert alert-danger text-center">
            Vui lòng kiểm tra lại dữ liệu nhập vào
        </div>
    @endif
    @if(session('msg'))
        <div class="alert alert-success">
            {{session('msg')}}
        </div>
    @endif
    <form action="" method="POST">
        <div class="form-group">
            <label for="">Tiêu đề bài viết</label>
            <input type="text" name="title" class="form-control" placeholder="Tiêu đề bài viết..." value="{{old('title') ?? $post->title}}">
            @error('title')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Nội dung bài viết</label>
            <textarea name="content" placeholder="Nội dung bài viết...." class="form-control" rows="10">{{old('content') ?? $post->content}}</textarea>
            @error('content')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit" >Cập nhật</button>
        @csrf
    </form>
@endsection