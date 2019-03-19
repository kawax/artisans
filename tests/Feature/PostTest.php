<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\Model\User;
use App\Model\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        $user1 = factory(User::class)->create();

        $response = $this->actingAs($user1)
                         ->withoutMiddleware()
                         ->post(route('post.store'), [
                             'title'   => 'test',
                             'message' => 'test',
                         ]);

        $this->assertDatabaseHas('posts', [
            'user_id' => $user1->id,
            'title'   => 'test',
        ]);

        $response->assertStatus(201);
    }

    public function testEdit()
    {
        $users = factory(User::class, 100)->create();
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $response = $this->actingAs($user1)
                         ->withoutMiddleware()
                         ->get('post/' . $post->id . '/edit');

        $response->assertStatus(200)
                 ->assertViewHas('post');
    }

    public function testEditDataAnother()
    {
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $user2 = factory(User::class)->create();

        $response = $this->actingAs($user2)
                         ->withoutMiddleware()
                         ->get('post/edit/' . $post->id);

        $response->assertStatus(403);
    }
}
