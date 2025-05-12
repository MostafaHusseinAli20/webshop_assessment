<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');
        
        $response->assertStatus(200)
        ->assertJsonCount(3, 'products');
    }
}
