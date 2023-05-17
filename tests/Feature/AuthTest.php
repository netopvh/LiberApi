<?php

namespace Tests\Feature;

use Database\Seeders\UserTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;


    public function test_validate_login_fields(): void
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->postJson('/api/login');

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'password']);
    }

    /**
     * Authenticate user
     */
    public function test_user_can_login(): void
    {
        $this->seed(UserTableSeeder::class);

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->postJson('/api/login', [
                'email' => 'admin@email.com',
                'password' => '123456',
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token', 'token_type', 'expires_in']]);
    }
}
