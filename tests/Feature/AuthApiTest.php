<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    /** @test */
    public function test_user_can_login_and_receive_token()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('123456789')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => '123456789'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'token',
                     'expires_in'
                 ]);
    }

    /** @test */
    public function authenticated_user_can_access_protected_route()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('123456789')
        ]);
        //$token = auth()->login($user);
        $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);

         $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->getJson('/api/auth/user');
        
         $response->assertStatus(200)
                 ->assertJsonFragment([
                     'email' => $user->email
                 ]);
    }

    /** @test */
    public function test_logout_user()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('123456789')
        ]);
        $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->postJson('/api/auth/logout');

        $response->assertStatus(200)
             ->assertJson([
                 'message' => 'Successfully logged out'
             ]);
    }
}
