<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function testUser()
    {
        $user = User::factory()->count(100)->create();

        $response = $this->get('/api/user');

        $response->assertStatus(200)
                 ->assertHeaderMissing('Link')
                 ->assertJson(
                     [
                         'meta' => [
                             'total' => 100,
                         ],
                     ]
                 )
                 ->assertJsonStructure(
                     [
                         'data' => [
                             [
                                 'id',
                                 'name',
                                 'avatar',
                                 'title',
                                 'message',
                                 'url',
                                 'image',
                                 'created_at',
                                 'updated_at',
                                 'tags',
                             ],
                         ],
                         'links',
                         'meta',
                     ]
                 );
    }

    public function testUserSearch()
    {
        $user = User::factory()->count(100)->create(
            [
                'title' => 'test',
            ]
        );

        $response = $this->get('/api/user?page=2&q=test&limit=10');

        $response->assertStatus(200)
                 ->assertJson(
                     [
                         'data' => [
                             [
                                 'title' => 'test',
                             ],
                         ],
                         'meta' => [
                             'current_page' => 2,
                             'per_page'     => 10,
                         ],
                     ]
                 );
    }

    public function testPost()
    {
        $user = User::factory()->create();
        $user->posts()->saveMany(Post::factory()->count(100)->make());

        $response = $this->withoutMiddleware()
                         ->get('/api/post?q=a');

        $response->assertStatus(200)
                 ->assertJson(
                     [
                         'meta' => [
                             'total' => 100,
                         ],
                     ]
                 )
                 ->assertJsonStructure(
                     [
                         'data' => [
                             [
                                 'id',
                                 'url',
                                 'image',
                                 'title',
                                 'message',
                                 'created_at',
                                 'updated_at',
                                 'user' => [
                                     'name',
                                     'avatar',
                                 ],
                             ],
                         ],
                         'links',
                         'meta',
                     ]
                 );
    }
}
