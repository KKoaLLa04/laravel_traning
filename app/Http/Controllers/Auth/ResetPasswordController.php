<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', 'min:8'],
        ];
    }

    protected function validationErrorMessages()
    {
        return [
            'token.required' => 'cái này thì chạy gì nữa',
            'email.required' => 'Email không được để trống',
            'email.email' => 'email không đúng định dạng',
            'password.required' => 'mật khẩu không được để trống',
            'password.confirmed' => 'mật khẩu không trùng khớp',
            'password.min' => 'Mật khẩu không được nhỏ hơn :min ký tự',
        ];
    }
}
