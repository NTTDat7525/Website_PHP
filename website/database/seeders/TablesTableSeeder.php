<?php

namespace Database\Seeders;
use App\Models\Table;
use Illuminate\Database\Seeder;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Table::create([
                'name' => 'Bàn số ' . $i,
                'capacity' => rand(2, 6),
                'status' => 'available',
            ]);
        }
    }
}