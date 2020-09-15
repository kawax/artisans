<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeedTest extends TestCase
{
    use RefreshDatabase;

    public function testUser()
    {
        $user = User::factory()->count(10)->create();

        $response = $this->get('/feed/user');

        $response->assertStatus(200);
    }

    public function testPost()
    {
        $users = User::factory()->count(10)->create();
        $post = $users->first()->posts()->create(Post::factory()->make()->toArray());

        $response = $this->get('/feed/post');

        $response->assertStatus(200);
    }
}
