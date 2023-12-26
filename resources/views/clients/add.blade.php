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
    <h3>Thêm sản phẩm mới</h3>
    @if($errors->all())
        <div class="alert alert-danger text-center">
            {{$message}}
        </div>
    @endif
    <form action="" method="post">
        <div class="mb-3">
            <label for="">Tên sản phẩm</label>
            <input type="text" class="form-control" placeholder="Tên sản phẩm..." name="name" value="{{old('name')}}">
            @error('name')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Giá sản phẩm</label>
            <input type="text" class="form-control" placeholder="Giá sản phẩm..." name="price" value="{{old('price')}}">
            @error('price')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        @csrf
        <button class="btn btn-primary">Thêm mới</button>
    </form>
    @endsection

