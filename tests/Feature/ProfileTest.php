<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function testProfileEdit()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200)
                 ->assertSee('profile-component');
    }

    public function testProfileMe()
    {
        $user = User::factory()->create(
            [
                'name' => 'test',
            ]
        );

        $response = $this->actingAs($user)->get('/profile/me');

        $response->assertStatus(200)
                 ->assertJson(
                     [
                         'name' => 'test',
                     ]
                 )
                 ->assertJsonStructure(
                     [
                         'id',
                         'name',
                         'title',
                         'message',
                         'tags',
                     ]
                 );
    }

    public function testProfileUpdate()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(
            '/profile',
            [
                'title'   => 'test',
                'message' => 'test',
                'tags'    => ['test'],
            ]
        );

        $this->assertDatabaseHas(
            'users',
            [
                'title'   => 'test',
                'message' => 'test',
            ]
        );

        $this->assertDatabaseHas(
            'tags',
            [
                'tag' => 'test',
            ]
        );

        $response->assertStatus(200);
    }

    public function testProfileDestroy()
    {
        $user = User::factory()->create(
            [
                'name' => 'test',
            ]
        );

        $response = $this->actingAs($user)->delete('/profile/destroy');

        $this->assertDatabaseMissing(
            'users',
            [
                'name' => 'test',
            ]
        );

        $response->assertRedirect();
    }
}
