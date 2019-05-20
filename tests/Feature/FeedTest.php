<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Model\User;
use App\Model\Post;

class FeedTest extends TestCase
{
    use RefreshDatabase;

    public function testUser()
    {
        $user = factory(User::class, 10)->create();

        $response = $this->get('/feed/user');

        $response->assertStatus(200);
    }

    public function testPost()
    {
        $users = factory(User::class, 10)->create();
        $post = $users->first()->posts()->create(factory(Post::class)->make()->toArray());

        $response = $this->get('/feed/post');

        $response->assertStatus(200);
    }
}
