<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parkings')->insert([
            [
                'name' => 'parking1',
                'situation' => '空車',
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'parking2',
                'situation' => '空車',
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'parking3',
                'situation' => '空車',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
