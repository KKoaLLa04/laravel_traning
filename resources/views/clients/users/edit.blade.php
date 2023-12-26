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
    @if($errors->any())
        <div class="alert alert-danger">Lỗi dữ liệu, vui lòng kiểm tra lại</div>
    @endif
    <form action="" method="POST">
        <div class="form-group">
            <label for="">Tên người dùng</label>
            <input type="text" class="form-control" name="name" placeholder="Tên người dùng..." value="{{old('name') ?? $detail->name}}">
            @error('name')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" placeholder="Email..." value="{{old('email') ?? $detail->email}}">
            @error('email')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="">Nhóm người dùng</label>
            <select name="group_id" class="form-control">
                <option value="0">Chọn nhóm người dùng</option>
                @if(!empty($allGroup))
                    @foreach($allGroup as $item)
                        <option value="{{$item->id}}" {{old('group_id')==$item->id || $detail->group_id==$item->id?'selected':false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="0" {{old('status')==0 || $detail->status==0?'selected':false}}>Chưa kích hoạt</option>
                <option value="1" {{old('status')==1 || $detail->status==1?'selected':false}}>Kích hoạt</option>
            </select>
        </div>
        @csrf
        <hr>
        <button type="submit" class="btn btn-info">Cập nhật</button>
        <a href="{{route('users.index')}}" class="btn btn-warning">Quay lai</a>
    </form>
@endsection

