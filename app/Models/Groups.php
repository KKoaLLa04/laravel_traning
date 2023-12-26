<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use App\Models\Users;

class Groups extends Model
{
    use HasFactory;

    protected $table = 'groups';

    public function getAll()
    {
        return DB::table($this->table)->get();
    }

    public function users()
    {
        return $this->hasMany(
            Users::class,
            'group_id',
            'id'
        );
    }

    public function postBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
