<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'title' => 'カット',
                'content' => '髪を切る',
                'price' => '4000',
                'menu_hour' => '0',
                'menu_minutes' => '30',
            ],

            [
                'title' => 'カラー',
                'content' => '染める',
                'price' => '10000',
                'menu_hour' => '1',
                'menu_minutes' => '30',
            ],

            [
                'title' => 'パーマ',
                'content' => 'パーマをかける',
                'price' => '15000',
                'menu_hour' => '2',
                'menu_minutes' => '0',
            ],

            [
                'title' => 'その他',
                'content' => 'その他',
                'price' => '5000',
                'menu_hour' => '1',
                'menu_minutes' => '0',
            ],

        ]);
    }
}
