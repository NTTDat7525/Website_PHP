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
            //SẢNH CHÍNH (4 bàn)
            ['name' => 'Bàn S1', 'capacity' => 2, 'location' => 'Sảnh chính', 'status' => 'available', 'price' => 0],
            ['name' => 'Bàn S2', 'capacity' => 4, 'location' => 'Sảnh chính', 'status' => 'available', 'price' => 0],
            ['name' => 'Bàn S3', 'capacity' => 6, 'location' => 'Sảnh chính', 'status' => 'available', 'price' => 0],
            ['name' => 'Bàn S4', 'capacity' => 8, 'location' => 'Sảnh chính', 'status' => 'available', 'price' => 0],

            //SÂN THƯỢNG (3 bàn)
            ['name' => 'Bàn T1', 'capacity' => 2, 'location' => 'Sân thượng', 'status' => 'available', 'price' => 50000],
            ['name' => 'Bàn T2', 'capacity' => 4, 'location' => 'Sân thượng', 'status' => 'available', 'price' => 70000],
            ['name' => 'Bàn T3', 'capacity' => 6, 'location' => 'Sân thượng', 'status' => 'available', 'price' => 100000],

            //KHU VIP (3 bàn)
            ['name' => 'Bàn VIP1', 'capacity' => 6, 'location' => 'Khu VIP', 'status' => 'available', 'price' => 150000],
            ['name' => 'Bàn VIP2', 'capacity' => 8, 'location' => 'Khu VIP', 'status' => 'available', 'price' => 200000],
            ['name' => 'Bàn VIP3', 'capacity' => 10, 'location' => 'Khu VIP', 'status' => 'available', 'price' => 300000]
        ]);
    }
}