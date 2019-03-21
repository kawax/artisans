<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\AnonymousNotifiable;
use App\Notifications\PostReportNotification;

use App\Model\User;
use App\Model\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        $users = factory(User::class, 100)->create();
        $user1 = factory(User::class)->create();

        $response = $this->actingAs($user1)
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
                         ->get(route('post.edit', $post));

        $response->assertStatus(200)
                 ->assertViewHas('post');
    }

    public function testEditDataAnother()
    {
        $users = factory(User::class, 100)->create();
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $user2 = factory(User::class)->create();

        $response = $this->actingAs($user2)
                         ->get('post/edit/' . $post->id);

        $response->assertStatus(403);
    }

    public function testUpdate()
    {
        $users = factory(User::class, 100)->create();
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $response = $this->actingAs($user1)
                         ->put(route('post.update', $post), [
                             'title' => 'test',
                         ]);

        $this->assertDatabaseMissing('posts', [
            'id'      => $post->id,
            'user_id' => $user1->id,
            'title'   => 'test',
        ]);

        $response->assertRedirect();
    }

    public function testUpdateAnother()
    {
        $users = factory(User::class, 100)->create();
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $user2 = factory(User::class)->create();

        $response = $this->actingAs($user2)
                         ->put(route('post.update', $post), [
                             'title' => 'test',
                         ]);

        $this->assertDatabaseHas('posts', [
            'id'      => $post->id,
            'user_id' => $user1->id,
        ]);

        $response->assertStatus(403);
    }

    public function testDestroy()
    {
        $users = factory(User::class, 100)->create();
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $response = $this->actingAs($user1)
                         ->delete(route('post.destroy', $post));

        $this->assertDatabaseMissing('posts', [
            'id'      => $post->id,
            'user_id' => $user1->id,
        ]);

        $response->assertRedirect();
    }

    public function testDestroyAnother()
    {
        $users = factory(User::class, 100)->create();
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $user2 = factory(User::class)->create();

        $response = $this->actingAs($user2)
                         ->delete(route('post.destroy', $post));

        $this->assertDatabaseHas('posts', [
            'id'      => $post->id,
            'user_id' => $user1->id,
        ]);

        $response->assertStatus(403);
    }

    public function testReport()
    {
        Notification::fake();

        $users = factory(User::class, 100)->create();
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $user2 = factory(User::class)->create();

        $response = $this->actingAs($user2)
                         ->post(route('post.report', $post), [
                             'reason' => 'test',
                         ]);

        Notification::assertSentTo(
            new AnonymousNotifiable, PostReportNotification::class,
            function ($notification, $channels) use ($post) {
                return $notification->post->id === $post->id;
            }
        );
    }
}
