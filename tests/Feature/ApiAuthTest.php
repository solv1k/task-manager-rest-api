<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

final class ApiAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_registration_route_has_a_validation(): void
    {
        $response = $this->postJson(route('api.auth.register'));

        $response->assertJsonValidationErrors(['email', 'password']);
    }

    public function test_the_user_can_register(): void
    {
        $registrationData = [
            'email' => 'test@user.com',
            'password' => 'Password123!',
        ];

        $response = $this->postJson(route('api.auth.register'), $registrationData);

        $response->assertSuccessful();
        $response->assertJsonStructure(['auth_token', 'user' => ['id', 'email', 'is_admin']]);
        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', ['email' => $registrationData['email']]);
    }

    public function test_the_registered_user_can_login(): void
    {
        $loginData = [
            'email' => 'test@user.com',
            'password' => 'Password123!',
        ];
        User::factory()->create([...$loginData, 'password' => Hash::make($loginData['password'])]);

        $response = $this->postJson(route('api.auth.login'), $loginData);

        $response->assertSuccessful();
        $response->assertJsonStructure(['auth_token', 'user' => ['id', 'email', 'is_admin']]);
    }
}
