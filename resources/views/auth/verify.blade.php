@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kích hoạt tài khoản</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    Trước khi sử dụng chức năng, vui lòng kích hoạt tài khoản được gửi trong email của bạn.
                    <br>
                    Nếu không nhận được email:
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Gửi lại</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
