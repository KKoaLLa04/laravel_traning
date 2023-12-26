@extends('layouts/admin')

@section('content')
    <h1 class="text-center">Danh sách người dùng</h1>
    @can('create', App\Models\User::class)
    <p><a href="{{route('admin.users.add')}}" class="btn btn-primary">Thêm người dùng mới</a></p>
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
                <th>Tên</th>
                <th>Email</th>
                <th>Nhóm</th>
                @can('users.edit', App\Models\User::class)
                <th width="5%">Sửa</th>
                @endcan
                @can('users.delete', App\Models\User::class)
                <th width="5%">Xóa</th>
                @endcan
            </tr>
        </thead>
        
        <tbody>
            @if(!empty($lists))
                @foreach($lists as $key => $item)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->group->name}}</td>
                @can('users.edit')
                <td><a href="{{route('admin.users.edit', $item->id)}}" class="btn btn-warning">Sửa</a></td>
                @endcan
                @can('users.delete')
                <td>
                    @if(Auth::user()->id != $item->id)
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.users.delete', $item->id)}}" class="btn btn-danger">Xóa</a>
                    @endif
                </td>
                @endcan
            </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection