<?php

namespace Tests\Unit;

use Database\Seeders\ProductTableSeeder;
use Database\Seeders\UserTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Support\GenerateToken;

class ProductTest extends TestCase
{
    use RefreshDatabase, GenerateToken;

    private string $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(UserTableSeeder::class);

        $this->token = $this->generateToken();
    }

    /**
     * Get a list of products
     */
    public function test_list_all_products(): void
    {
        $response = $this->apiGet('/api/product');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }

    public function test_get_a_invalid_product()
    {
        $response = $this->apiGet('/api/product/0');

        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => 'Product not found']);
    }

    public function test_get_a_specific_product()
    {

        $this->seed(ProductTableSeeder::class);

        $response = $this->apiGet('/api/product/1');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }

    private function apiGet(string $url): \Illuminate\Testing\TestResponse
    {
        return $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->getJson($url);
    }
}
