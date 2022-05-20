<?php

namespace Database\Seeders;

use App\Models\ModelUsers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id_member'=>"1",
                'full_name'=>"Admin",
                'phone_number'=>"0894382948932",
                'email' =>'admin@gmail.com',
                'password'=>Hash::make('admin'),
                'role'=>1
            ],
            [
                'id_member'=>"10",
                'full_name'=>"Genta",
                'phone_number'=>"0894382948932",
                'email' =>'genta@gmail.com',
                'password'=>Hash::make('123'),
                'role'=>0
            ]
            ];
        DB::table('tbl_users')->insert($users);
    }
}
