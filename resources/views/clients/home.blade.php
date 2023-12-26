@extends('layouts.client')

@section('title')
    {{$title}}
@endsection

@section('css')

@endsection

@section('sidebar')
    @parent
    <h3>Home sidebar</h3>
@endsection

@section('content')
    <h2>Nội dung</h2>
    @include('clients.contents.aboutus')
    @include('clients.contents.aboutus')

    <x-package-alert type="info" :content="$title" />
    <x-input-button/>
    <x-form-button/>
@endsection

