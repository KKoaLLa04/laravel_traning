<h1>Trang dành cho bác sỹ</h1>
<a class="dropdown-item" href="{{ route('doctors.logout')
}}" onclick="event.preventDefault();
document.getElementById('logout-form').submit();">Đăng xuất </a>

<form id="logout-form" action="{{ route('doctors.logout')
}}" method="POST" class="d-none">
@csrf
</form>