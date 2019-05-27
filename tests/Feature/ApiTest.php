<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Model\User;
use App\Model\Post;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function testUser()
    {
        $user = factory(User::class, 100)->create();

        $response = $this->get('/api/user');

        $response->assertStatus(200)
                 ->assertHeaderMissing('Link')
                 ->assertJson([
                     'meta' => [
                         'total' => 100,
                     ],
                 ])
                 ->assertJsonStructure([
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
                 ]);
    }

    public function testUserSearch()
    {
        $user = factory(User::class, 100)->create([
            'title' => 'test',
        ]);

        $response = $this->get('/api/user?page=2&q=test&limit=10');

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         [
                             'title' => 'test',
                         ],
                     ],
                     'meta' => [
                         'current_page' => 2,
                         'per_page'     => 10,
                     ],
                 ]);
    }

    public function testPost()
    {
        $user = factory(User::class)->create();
        $user->posts()->saveMany(factory(Post::class, 100)->make());

        $response = $this->withoutMiddleware()
                         ->get('/api/post?q=a');

        $response->assertStatus(200)
                 ->assertJson([
                     'meta' => [
                         'total' => 100,
                     ],
                 ])
                 ->assertJsonStructure([
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
                 ]);
    }
}
