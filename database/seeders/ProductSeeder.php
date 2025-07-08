<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'product_name' => 'Test Product 1',
                'quantity' => 5,
                'price' => 99.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Test Product 2',
                'quantity' => 10,
                'price' => 49.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Test Product 3',
                'quantity' => 15,
                'price' => 29.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Test Product 4',
                'quantity' => 8,
                'price' => 59.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Test Product 5',
                'quantity' => 20,
                'price' => 19.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Test Product 6',
                'quantity' => 12,
                'price' => 75.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Test Product 7',
                'quantity' => 7,
                'price' => 199.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Test Product 8',
                'quantity' => 9,
                'price' => 39.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Test Product 9',
                'quantity' => 6,
                'price' => 99.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Test Product 10',
                'quantity' => 25,
                'price' => 9.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}