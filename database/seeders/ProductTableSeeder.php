<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->delete();
        $products = [
            [
                "id" => 1,
                "name" => "Laptop",
                "description" => "High-performance laptop",
                "price" => 1500,
                "stock_quantity" => 10
            ],
            [
                "id" => 2,
                "name" => "Smartphone",
                "description" => "Latest model smartphone",
                "price" => 1000,
                "stock_quantity" => 15
            ],
            [
                "id" => 3,
                "name" => "Headphones",
                "description" => "Noise-cancelling headphones",
                "price" => 200,
                "stock_quantity" => 20
            ]
        ];

        foreach($products as $product) {
            Product::create($product);
        }
    }
}
