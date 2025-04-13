<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'name' => 'Laptop',
                'description' => 'High performance laptop with 16GB RAM',
                'price' => 999.99,
                'quantity' => 10,
                'is_active' => true
            ],
            [
                'name' => 'Smartphone',
                'description' => 'Latest smartphone with 5G support',
                'price' => 699.99,
                'quantity' => 20,
                'is_active' => true
            ],
            [
                'name' => 'Headphones',
                'description' => 'Noise cancelling wireless headphones',
                'price' => 199.99,
                'quantity' => 30,
                'is_active' => true
            ],
            [
                'name' => 'Keyboard',
                'description' => 'Mechanical gaming keyboard',
                'price' => 129.99,
                'quantity' => 15,
                'is_active' => false
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
