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
    <a href="{{route('users.add')}}"><button class="btn btn-primary">Thêm người dùng</button></a>
    <hr>
    <form action="" method="GET" class="mb-3">
        <div class="row">
            <div class="col-3">
                <select name="status" class="form-control">
                    <option value="">Tất cả trạng thái</option>
                    <option value="active" {{request()->status=='active'?'selected':false}}>Kích hoạt</option>
                    <option value="inAcitve" {{request()->status=='inActive'?'selected':false}}>Chưa kích hoạt</option>
                </select>
            </div>
            <div class="col-3">
                <select name="group_id" class="form-control">
                    <option value="0">Tất cả các nhóm</option>
                    @if(!empty(getAllGroup()))
                        @foreach(getAllGroup() as $item)
                            <option value="{{$item->id}}" {{request()->group_id==$item->id?'selected':false}}>{{$item->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-4">
                <input type="text" name="keywords" placeholder="Từ khóa tìm kiếm..." class="form-control" value="{{request()->keywords}}">
            </div>

            <div class="col-2">
                <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="3%">STT</th>
                <th><a href="?sortBy=name&sortType={{$sortType}}">Họ tên</a></th>
                <th><a href="?sortBy=email&sortType={{$sortType}}">Email</a></th>
                <th><a href="?sortBy=group_id&sortType={{$sortType}}">Nhóm</a></th>
                <th width="20%"><a href="?sortBy=status&sortType={{$sortType}}">Trạng thái</a></th>
                <th width=""><a href="?sortBy=create_at&sortType={{$sortType}}">Thời gian</a></th>
                <th width="7%">Sửa</th>
                <th width="7%">Xóa</th>
            </tr>
        </thead>

        <tbody>
            @if(!empty($userLists))
            @foreach($userLists as $key => $item)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->group_name}}</td>
                <td>{!!$item->status==0?'<button class="btn btn-danger btn-sm">Chưa kích hoạt</button>':'<button class="btn btn-success btn-sm">Đã kích hoạt</button>'!!}</td>
                <td>{{$item->created_at}}</td>
                <td><a href="{{route('users.edit', ['id' => $item->id])}}" class="btn btn-warning">Sửa</a></td>
                <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('users.delete', ['id' => $item->id])}}" class="btn btn-danger">Xóa</a></td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4">Không có người dùng</td>
            </tr>
            @endif
        </tbody>
    </table>

   <div class="d-flex justify-content-end">
    {{$userLists->links()}}
   </div>
@endsection

