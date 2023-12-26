<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\UserSeeder;
use Database\Seeders\PostSeeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // $groupId = DB::table('groups')->insertGetId([
        //     'name' => 'Administrator',
        //     'user_id' => 0,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);

        // DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // if ($groupId > 0) {
        //     $userId = DB::table('users')->insertGetId([
        //         'name' => 'Duy kiên',
        //         'email' => 'ndkdzvl@gmail.com',
        //         'password' => Hash::make('123456'),
        //         'group_id' => $groupId,
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ]);

        //     if ($userId > 0) {
        //         for ($i = 0; $i <= 10; $i++) {
        //             DB::table('posts')->insert([
        //                 'title' => 'Tieu de ' . $i,
        //                 'content' => 'content ' . $i,
        //                 'description' => 'mo ta ngan ' . $i,
        //                 'user_id' => $userId,
        //                 'created_at' => date('Y-m-d H:i:s'),
        //                 'updated_at' => date('Y-m-d H:i:s'),
        //             ]);
        //         }
        //     }
        // }

        DB::table('modules')->insert([
            'name' => 'users',
            'title' => 'Quản lý người dùng',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('modules')->insert([
            'name' => 'posts',
            'title' => 'Quản lý bài viết',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('modules')->insert([
            'name' => 'groups',
            'title' => 'Quản lý nhóm người dùng',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
