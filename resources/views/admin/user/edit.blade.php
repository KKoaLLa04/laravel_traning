@extends('layouts/admin')

@section('content')
    <h1 class="text-center">Cập nhật người dùng</h1>
    <p><a href="{{route('admin.users.index')}}" class="btn btn-primary">Quay lại</a></p>
    @if($errors->any())
        <div class="alert alert-danger text-center">
            Vui lòng kiểm tra lại dữ liệu nhập vào
        </div>
    @endif
    @if(session('msg'))
        <div class="alert alert-success text-center">
        {{session('msg')}}
        </div>
    @endif
    <form action="" method="POST">
        <div class="form-group">
            <label for="">Tên người dùng</label>
            <input type="text" name="name" class="form-control" placeholder="Tên người dùng..." value="{{old('name') ?? $user->name}}">
            @error('name')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Email người dùng</label>
            <input type="text" name="email" class="form-control" placeholder="Email người dùng..." value="{{old('email') ?? $user->email}}">
            @error('email')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Mật khẩu (Không nhập nếu không đổi)</label>
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu..." >
            @error('password')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Nhóm người dùng</label>
            <select name="group_id" class="form-control">
                <option value="0">Chọn nhóm người dùng</option>
                @if(!empty($groups))
                    @foreach($groups as $item)
                        <option value="{{$item->id}}" {{old('group_id')==$item->id || $user->group_id == $item->id ? 'selected':false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit" >Thêm mới</button>
        @csrf
    </form>
@endsection