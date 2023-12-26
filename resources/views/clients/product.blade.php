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
    <h3>Content trang chủ</h3>
    <h4>Tiếp nè</h4>
    @if(session('msg'))
        <div class="alert alert-info">{{session('msg')}}</div>
    @endif
@endsection

