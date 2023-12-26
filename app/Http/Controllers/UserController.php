<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Users;

use App\Models\Phone;

use App\Models\Groups;

use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    private $users;

    const _PER_PAGE = 5;
    public function __construct()
    {
        $this->users = new Users;
    }
    public function index(Request $request)
    {
        $title = 'Danh sách người dùng';

        $filter = [];
        $keywords = null;
        if (!empty($request->status)) {
            $status = $request->status;

            if ($status == 'active') {
                $status = 1;
            } else {
                $status = 0;
            }

            $filter[] = ['status', '=', $status];
        }

        if (!empty($request->group_id)) {
            $groupId = $request->group_id;

            $filter[] = ['group_id', '=', $groupId];
        }

        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }

        $sortBy = $request->sortBy;
        $sortType = $request->sortType;

        if (!empty($sortType)) {
            if ($sortType == 'desc') {
                $sortType = 'asc';
            } else {
                $sortType = 'desc';
            }
        } else {
            $sortType = 'asc';
        }

        if (!empty($sortType) && !empty($sortBy)) {
            $sortArr = [
                'sortBy' => $sortBy,
                'sortType' => $sortType,
            ];
        } else {
            $sortArr = null;
        }
        $userLists = $this->users->getAllList($filter, $keywords, $sortArr, self::_PER_PAGE);

        return view('clients.users.lists', compact('title', 'userLists', 'sortType'));
    }

    public function add()
    {
        $title = 'Thêm người dùng';

        $allGroup = getAllGroup();


        return view('clients.users.add', compact('title', 'allGroup'));
    }

    public function postAdd(UserRequest $request)
    {

        $data = [
            'name' => trim($request->name),
            'email' => trim($request->email),
            'group_id' => trim($request->group_id),
            'status' => trim($request->status),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->users->addUser($data);

        return redirect(route('users.index'))->with('msg', 'Thêm người dùng thành công');
    }

    public function edit($id)
    {
        $title = 'Cập nhật người dùng';
        if (!empty($id)) {
            $detail = $this->users->getDetail($id);
            if (!empty($detail[0])) {
                $detail = $detail[0];
            } else {
                return redirect(route('users.index'))->with('msg', 'Người dùng không tồn tại');
            }
        } else {
            return redirect(route('users.index'))->with('msg', 'Liên kết không tồn tại hoặc đã hết hạn');
        }

        $allGroup = getAllGroup();
        return view('clients.users.edit', compact('title', 'detail', 'allGroup'));
    }

    public function postEdit(Request $request, $id = 0)
    {

        $request->validate([
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users,email,' . $id,
            'group_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail('Nhóm người dùng không được để trống');
                }
            }],
            'status' => 'required|integer',
        ], [
            'name.required' => 'Họ và tên bắt buộc phải nhập!',
            'name.min' => 'Tên người dùng không được nhỏ hơn :min ký tự',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'group_id.required' => 'Nhóm người dùng không được để trống',
            'group_id.integer' => 'Nhóm người dùng không hợp lệ',
            'status.required' => 'Tình trạng không được để trống',
            'status.integer' => 'Tình trạng không hợp lệ',
        ]);



        $data = [
            'name' => trim($request->name),
            'email' => trim($request->email),
            'group_id' => trim($request->group_id),
            'status' => trim($request->status),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->users->updateUser($data, $id);

        return back()->with('msg', 'Cập nhật người dùng thành công');
    }

    public function delete($id)
    {
        $title = 'Danh sách người dùng';
        if (!empty($id)) {
            $detail = $this->users->getDetail($id);
            if (!empty($detail[0])) {
                $deleteStatus = $this->users->deleteUser($id);

                if (!empty($deleteStatus)) {
                    $msg = "Xóa người dùng thành công";
                } else {
                    $msg = "Lỗi hệ thống, vui lòng thử lại sau";
                }
            } else {
                $msg = 'Người dùng không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại hoặc đã hết hạn';
        }

        return redirect(route('users.index'))->with('msg', $msg);
    }

    public function relations()
    {
        // $phone = Users::where('id', 12)->first()->phone;
        // $phoneNumber = $phone->phone;
        // $id = $phone->id;
        // echo 'id Phone: ' . $id . '<br/>';
        // echo 'Number phone: ' . $phoneNumber . '</br>';
        // dd($phone);

        // $user = Phone::where('phone', '0123654789')->first()->User;
        // $fullname = $user->name;
        // $id = $user->id;
        // echo 'Id: ' . $id . '<br/>';
        // echo 'Fullname: ' . $fullname . '<br/>';

        // $users = Groups::find(1)->users()->where('id', '>=', 15)->get();
        // if ($users->count() > 0) {
        //     foreach ($users as $item) {
        //         echo 'Fullname: ' . $item->name . '<br/>';
        //     }
        // }
        // dd($users);

        $group = Users::find(12)->group;
        dd($group);
    }
}
