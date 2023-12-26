<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Groups;
use App\Models\Modules;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class GroupsController extends Controller
{
    public function index()
    {
        $lists = Groups::all();
        return view('admin.groups.lists', compact('lists'));
    }

    public function add()
    {
        return view('admin.groups.add');
    }

    public function postAdd(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:groups,name'
            ],
            [
                'name.required' => 'Nhóm người dùng bắt buộc phải nhập',
                'name.unique' => 'Nhóm người dùng đã tồn tại',
            ]
        );

        $groups = new Groups();
        $groups->name = $request->name;
        $groups->user_id = FacadesAuth::user()->id;
        $groups->created_at = date('Y-m-d H:i:s');
        $groups->save();

        return redirect()->route('admin.groups.index')->with('msg', 'Thêm nhóm người dùng mới thành công!');
    }

    public function edit(Groups $group)
    {
        return view('admin.groups.edit', compact('group'));
    }

    public function postEdit(Groups $group, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:groups,name,' . $group->id
            ],
            [
                'name.required' => 'Nhóm người dùng bắt buộc phải nhập',
                'name.unique' => 'Nhóm người dùng đã tồn tại',
            ]
        );

        $group->name = $request->name;
        $group->user_id = FacadesAuth::user()->id;
        $group->created_at = date('Y-m-d H:i:s');
        $group->save();

        return back()->with('msg', 'Cập nhật nhóm người dùng mới thành công!');
    }

    public function delete(Groups $group)
    {
        $userCount = $group->users->count();
        if ($userCount == 0) {
            Groups::destroy($group->id);
            return redirect()->route('admin.groups.index')->with('msg', 'Xóa nhóm người dùng thành công!');
        }

        return redirect()->route('admin.groups.index')->with('msg', 'Nhóm người dùng hiện còn ' . $userCount . ' Người dùng, không thể xóa');
    }

    public function permissions($id)
    {
        $groups = Groups::find($id);
        $modules = Modules::all();

        $roleListArr = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa'
        ];

        $roleJson = $groups->permissions;
        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
        } else {
            $roleArr = [];
        }

        return view('admin.groups.permissions', compact(
            'groups',
            'modules',
            'roleListArr',
            'roleArr',
        ));
    }

    public function postPermissions(Groups $groups, Request $request)
    {

        if (!empty($request->role)) {
            $roleArr = $request->role;
        } else {
            $roleArr = [];
        }

        $roleJson = json_encode($roleArr);
        $groups->permissions = $roleJson;
        $groups->save();

        return back()->with('msg', 'Phân quyền nhóm ' . $groups->name . ' Thành công');
    }
}
