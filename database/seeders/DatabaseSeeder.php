<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reserve;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            StylistSeeder::class,
            ParkingSeeder::class,
            UsersSeeder::class,
            MenusSeeder::class,
        ]);

        Reserve::factory(100)->create();
    }
}
