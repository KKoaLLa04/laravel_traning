@extends('layouts/admin')

@section('content')
    <h1 class="text-center">Cập nhập người dùng</h1>
    <p><a href="{{route('admin.groups.index')}}" class="btn btn-primary">Quay lại</a></p>
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
            <label for="">Tên nhóm người dùng</label>
            <input type="text" name="name" class="form-control" placeholder="Tên nhóm người dùng..." value="{{old('name') ?? $group->name}}">
            @error('name')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit" >Cập nhật</button>
        @csrf
    </form>
@endsection