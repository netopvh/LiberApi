<?php

namespace Tests\Support;

trait GenerateToken
{
    public function generateToken()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->postJson('/api/login', [
                'email' => 'admin@email.com',
                'password' => '123456',
            ]);

        return $response->json()['data']['token'];
    }
}
