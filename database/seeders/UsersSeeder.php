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
                'email' => 'user1@user.com',
                'password' => Hash::make('user1234'),
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'user2',
                'email' => 'user2@user.com',
                'password' => Hash::make('user1234'),
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'user3',
                'email' => 'user3@user.com',
                'password' => Hash::make('user1234'),
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'user4',
                'email' => 'user4@user.com',
                'password' => Hash::make('user1234'),
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'user5',
                'email' => 'user5@user.com',
                'password' => Hash::make('user1234'),
                'created_at' => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}
