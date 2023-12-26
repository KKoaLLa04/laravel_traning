<?php

namespace App\Http\Controllers\Doctors\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth as FacadesAuth;

class LoginController extends Controller
{

    public function login()
    {
        return view('doctors.login');
    }

    public function postLogin(Request $request)
    {
        // validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        $loginData = $request->except('_token');

        if (isActiveDoctor($loginData['email'])) {

            $check = FacadesAuth::guard('doctor')->attempt($loginData);
            if ($check) {
                return redirect('doctors');
            }

            return back()->with('msg', 'Email hoặc mật khẩu không chính xác');
        }

        return back()->with('msg', 'Tài khoản chưa được kích hoạt');
    }
}
