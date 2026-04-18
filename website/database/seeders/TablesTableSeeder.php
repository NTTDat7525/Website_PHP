<?php

namespace Database\Seeders;
use App\Models\Table;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tables')->insert([
            [
                'name' => 'Bàn 2 người - A1',
                'capacity' => 2,
                'location' => 'Tầng 1',
                'status' => 'available',
                'price' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bàn 4 người - A2',
                'capacity' => 4,
                'location' => 'Tầng 1',
                'status' => 'available',
                'price' => 200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bàn 6 người - B1',
                'capacity' => 6,
                'location' => 'Tầng 2',
                'status' => 'available',
                'price' => 300000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bàn VIP - V1',
                'capacity' => 10,
                'location' => 'Phòng VIP',
                'status' => 'available',
                'price' => 800000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}