<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stylists')->insert([
            [
                'name' => 'stylist1',
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'stylist2',
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'stylist3',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
