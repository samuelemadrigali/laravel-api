<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_data()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/api/user');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'createdAt',
            'updatedAt',
        ]);
    }
}
