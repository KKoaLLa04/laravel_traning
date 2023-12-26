<h1>Admin dashboard</h1>

@if(Auth::check())
<h2>Đã đăng nhập</h2>
<h4>id: {{$userDetail->id}}</h4>
<h4>email: {{$userDetail->email}}</h4>
<h4>ho va ten: {{$userDetail->name}}</h4>
<h4>ho va ten: {{$userDetail->name}}</h4>
@else
<h2>Vui lòng đăng nhập</h2>
@endif