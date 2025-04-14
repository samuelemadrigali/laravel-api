<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create some projects
        Project::factory()->count(5)->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'createdAt',
                    'updatedAt',
                ],
            ],
            'links' => [],
            'meta' => [],
        ]);
    }

    public function test_show()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a project
        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->getJson("/api/projects/{$project->id}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'title',
            'description',
            'createdAt',
            'updatedAt',
        ]);
    }

    public function test_store()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'title' => 'New Project',
            'description' => 'Project description',
            'userId' => $user->id,
        ];

        $response = $this->postJson('/api/projects', $data);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'title',
            'description',
            'createdAt',
            'updatedAt',
        ]);
    }

    public function test_update()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a project
        $project = Project::factory()->create(['user_id' => $user->id]);

        $data = [
            'title' => 'Updated Project',
            'description' => 'Updated description',
            'userId' => $user->id,
        ];

        $response = $this->putJson("/api/projects/{$project->id}", $data);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'title',
            'description',
            'createdAt',
            'updatedAt',
        ]);
    }

    public function test_destroy()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a project
        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(204);
    }
}
