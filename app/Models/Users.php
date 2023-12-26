<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use App\Models\Phone;

use App\Models\Groups;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function phone()
    {
        return $this->hasOne(
            Phone::class,
            'user_id',
            'id'
        );
    }

    public function group()
    {
        return $this->belongsTo(
            Groups::class,
            'group_id',
            'id'
        );
    }
    public function getAllList($filter = [], $keywords = null, $sortArr = null, $perPage = null)
    {
        // $users = DB::select("SELECT * FROM users WHERE id > ? ORDER BY created_at DESC", [0]);

        $users = DB::table($this->table)
            ->select('users.*', 'groups.name as group_name')
            ->join('groups', 'groups.id', '=', 'users.group_id')
            ->where('trash', 0);

        $orderBy = 'groups.name';
        $orderType = 'desc';

        if (!empty($sortArr) && is_array($sortArr)) {
            if (!empty($sortArr['sortBy']) && !empty($sortArr['sortType'])) {
                $orderBy = $sortArr['sortBy'];
                $orderType = $sortArr['sortType'];
            }
        }

        $users = $users->orderBy($orderBy, $orderType);
        if (!empty($filter)) {
            $users = $users->where($filter);
        }
        if (!empty($keywords)) {
            $users = $users->where(function ($query) use ($keywords) {
                $query->orWhere('users.name', 'LIKE', "%$keywords%");
                $query->orWhere('users.email', 'LIKE', "%$keywords%");
            });
        }

        if (!empty($perPage)) {
            $users = $users->paginate($perPage)->withQueryString();
        } else {
            $users = $users->get();
        }

        return $users;
    }

    public function addUser($data)
    {
        // $users = DB::insert('INSERT INTO users (name, email) VALUE(?, ?)', $data);
        return DB::table($this->table)->insert($data);
    }

    public function getDetail($id)
    {
        return DB::select("SELECT * FROM users WHERE id= ?", [$id]);
    }

    public function updateUser($data, $id)
    {
        // DB::update("UPDATE users SET name=?, email=?, updated_at = ? WHERE id= ?", $data);
        return DB::table($this->table)->where('id', $id)->update($data);
    }

    public function deleteUser($id)
    {
        return DB::delete("DELETE FROM users WHERE id = ?", [$id]);
    }

    public function learnQueryBuilder()
    {
        DB::enableQueryLog();
        $id = 12;
        $lists =
            DB::table('users')
            ->select('name', 'email', 'id')
            ->where('id', 11)
            ->where(function ($query) use ($id) {
                $query->where('id', '>', $id)->orWhere('id', '<', $id);
            })
            ->get();
        // dd($lists);

        $sql = DB::getQueryLog();
        dd($sql);

        $detail = DB::table('users')->select('name', 'email', 'id')->first();
        dd($detail);
    }
}
