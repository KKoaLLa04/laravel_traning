@extends('layouts.client')

@section('title')
    {{$title}}
@endsection

@section('css')
@endsection

@section('sidebar')
    <h3>PRODUCT SIDEBAR</h3>
@endsection

@section('content')
    <h3>{{$title}}</h3>
    @if(session('msg'))
        <div class="alert alert-info">{{session('msg')}}</div>
    @endif
    <form action="{{route('posts.delete-any')}}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
        <button class="btn btn-danger" type="submit">Xóa (0)</button>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="3%">
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th width="5%">STT</th>
                    <th>Tiêu đề</th>
                    <th>Trang thai</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @if(!empty($allData))
                    @foreach($allData as $key => $item)
                <tr>
                    <td><input type="checkbox" name="delete[]" value="{{$item->id}}"></td>
                    <td>{{$key+1}}</td>
                    <td>{{$item->title}}</td>
                    @if($item->trashed())
                    <td><button class="btn btn-danger">Đã xóa</button></td>
                    @else
                    <td><button class="btn btn-success">Chưa xóa</button></td>
                    @endif
                    @if($item->trashed())
                    <td>
                        <a href="{{route('posts.restore', $item)}}" class="btn btn-primary">Khôi phục</a>
                        <a href="{{route('posts.force-delete', $item)}}" class="btn btn-danger">Xóa vĩnh viễn</a>
                    </td>
                    @endif
                </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        @csrf
    </form>
@endsection
