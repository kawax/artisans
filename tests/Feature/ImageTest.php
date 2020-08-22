<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        config(['artisans.font' => 1]);
    }

    public function testHome()
    {
        $response = $this->get(route('image.home'));

        $response->assertStatus(200)
                 ->assertHeader('Content-Type', 'image/jpeg')
                 ->assertHeaderMissing('Link');
    }

    public function testUser()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('image.user', $user));

        $response->assertStatus(200);
    }

    public function testPost()
    {
        $user = factory(User::class)->create();

        $post = $user->posts()->create(factory(Post::class)->make()->toArray());

        $response = $this->get(route('image.post', $post));

        $response->assertStatus(200);
    }
}
