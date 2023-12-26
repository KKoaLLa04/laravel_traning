<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
                $this->username() => 'required|string',
                'password' => 'required|string|min:6',
            ],
            [
                $this->username() . '.required' => 'Tên đăng nhập không được để trống',
                $this->username() . '.string' => 'Tên đăng nhập phải là dạng chuỗi',
                // $this->username() . '.email' => 'Tên đăng nhập không đúng định dạng email',
                'password.required' => 'mật khẩu không được để trống',
                'password.string' => 'mật khẩu phải là chữ',
                'password.min' => 'mật khẩu không được nhỏ hơn :min ký tự',
            ]
        );
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Tên đăng nhập hoặc mật khẩu sai'],
        ]);
    }

    public function username()
    {
        return 'username';
    }

    protected function credentials(Request $request)
    {
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $fieldDb = 'email';
        } else {
            $fieldDb = 'username';
        }

        $dataArr = [
            $fieldDb => $request->username,
            'password' => $request->password,
        ];

        return $dataArr;
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/admin');
    }
}
