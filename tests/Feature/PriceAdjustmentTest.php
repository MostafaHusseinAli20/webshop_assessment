<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriceAdjustmentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    /** @test */
    public function test_price_increases_when_stock_is_low(): void
    {
        $product = Product::factory()->create([
            'price' => 100,
            'stock_quantity' => 4
        ]);

        $response = $this->putJson("/api/product/{$product->id}/update", [
            'name' => 'Updated',
            'description' => 'Test',
            'price' => 100,
            'stock_quantity' => 4
        ]);

        $response->assertStatus(200);
        $this->assertEquals(110, round($product->fresh()->price));
    }

    /** @test */
    public function test_price_decreases_when_stock_is_high()
    {
        $product = Product::factory()->create([
            'price' => 100,
            'stock_quantity' => 25
        ]);

        $response = $this->putJson("/api/product/{$product->id}/update", [
            'name' => 'Updated',
            'description' => 'Test',
            'price' => 100,
            'stock_quantity' => 25
        ]);

        $response->assertStatus(200);
        $this->assertEquals(90, round($product->fresh()->price));
    }

}
