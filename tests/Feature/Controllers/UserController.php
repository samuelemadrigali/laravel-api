<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;

class UserController extends TestCase
{
    /**
     * Test if the authenticated user can be retrieved.
     */
    public function test_get_user(): void
    {
        $response = $this->getJson('/api/user');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'createdAt',
                'updatedAt',
            ]);
    }
}
