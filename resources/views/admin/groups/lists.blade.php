@extends('layouts/admin')

@section('content')
    <h1 class="text-center">Danh sách Nhóm người dùng</h1>
    <p><a href="{{route('admin.groups.add')}}" class="btn btn-primary">Thêm nhóm người dùng mới</a></p>
    @if(session('msg'))
    <div class="alert alert-success">
        {{session('msg')}}
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Tên</th>
                <th width="15%">Người đăng</th>
                <th width="15%">Phân quyền</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
        </thead>
        
        <tbody>
            @if(!empty($lists))
                @foreach($lists as $key => $item)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->name}}</td>
                <td>{{!empty($item->postBy->name)? $item->postBy->name :false}}</td>
                <td class="text-center"><a href="{{route('admin.groups.permissions', $item)}}" class="btn btn-primary">Phân quyền</a></td>
                <td><a href="{{route('admin.groups.edit', $item->id)}}" class="btn btn-warning">Sửa</a></td>
                <td>
                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.groups.delete', $item->id)}}" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection