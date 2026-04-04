<?php

namespace Database\Seeders;
use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [
            ['name' => 'Phở bò','price' => 50000, 'category' => 'Món chính'],
            ['name' => 'Bún chả', 'price' => 45000, 'category' => 'Món chính'],
            ['name' => 'Gỏi cuốn', 'price' => 30000, 'category' => 'Món khai vị'],
            ['name' => 'Chả giò', 'price' => 35000, 'category' => 'Món khai vị'],
            ['name' => 'Cơm tấm', 'price' => 40000, 'category' => 'Món chính'],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}