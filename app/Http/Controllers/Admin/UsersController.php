<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Groups;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $lists = User::all();
        return view('admin.user.lists', compact('lists'));
    }

    public function add()
    {
        $groups = Groups::all();
        return view('admin.user.add', compact('groups'));
    }

    public function postAdd(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3',
                'group_id' => ['required', function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail('Vui lòng chọn nhóm!');
                    }
                }],
            ],
            [
                'name.required' => 'Tên người dùng không được để trống!',
                'name.min' => 'Tên người dùng không được nhỏ hơn :min ký tự',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã có người sử dụng',
                'password.required' => 'Mật khẩu không được để trống!',
                'password.min' => 'Mật khẩu không được nhỏ hơn :min ký tự',
                'group_id' => 'Nhóm bắt buộc phải chọn',
            ]
        );

        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->group_id = $request->group_id;
        $users->save();
        return redirect()->route('admin.users.index')->with('msg', 'Thêm người dùng mới thành công');
    }

    public function edit(User $user)
    {
        $this->authorize('delete', $user);
        $groups = Groups::all();
        return view('admin.user.edit', compact('groups', 'user'));
    }

    public function postEdit(User $user, Request $request)
    {
        $this->authorize('delete', $user);
        $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'group_id' => ['required', function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail('Vui lòng chọn nhóm!');
                    }
                }],
            ],
            [
                'name.required' => 'Tên người dùng không được để trống!',
                'name.min' => 'Tên người dùng không được nhỏ hơn :min ký tự',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã có người sử dụng',
                'group_id' => 'Nhóm bắt buộc phải chọn',
            ]
        );

        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->group_id = $request->group_id;
        $user->save();
        return back()->with('msg', 'Cập nhật người dùng thành công');
    }

    public function delete(User $user)
    {
        $this->authorize('delete', $user);
        if (Auth::user()->id !== $user->id) {
            User::destroy($user->id);

            return redirect()->route('admin.users.index')->with('msg', 'Xóa người dùng thành công!');
        }

        return redirect()->route('admin.users.index')->with('msg', 'Không thể xóa tài khoản này');
    }
}
