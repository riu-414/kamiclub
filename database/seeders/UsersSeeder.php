<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'user1',
                'sex' => '男',
                'birthday' => '2023-01-01',
                'email' => 'user1@user.com',
                'phone' => '08011110000',
                'password' => Hash::make('user1234'),
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'user2',
                'sex' => '女',
                'birthday' => '2023-02-02',
                'email' => 'user2@user.com',
                'phone' => '08022220000',
                'password' => Hash::make('user1234'),
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'user3',
                'sex' => '男',
                'birthday' => '2023-03-03',
                'email' => 'user3@user.com',
                'phone' => '08033330000',
                'password' => Hash::make('user1234'),
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'user4',
                'sex' => '女',
                'birthday' => '2023-04-04',
                'email' => 'user4@user.com',
                'phone' => '08044440000',
                'password' => Hash::make('user1234'),
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'user5',
                'sex' => '女',
                'birthday' => '2023-05-05',
                'email' => 'user5@user.com',
                'phone' => '08055550000',
                'password' => Hash::make('user1234'),
                'created_at' => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}
