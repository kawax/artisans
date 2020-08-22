<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Notifications\PostReportNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('post.index'));

        $response->assertSuccessful();
    }

    public function testShow()
    {
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $response = $this->actingAs($user1)
                         ->get(route('post.show', $post));

        $response->assertSuccessful()
                 ->assertViewHas('post');
    }

    public function testCreate()
    {
        $user1 = factory(User::class)->create();

        $response = $this->actingAs($user1)
                         ->get(route('post.create'));

        $response->assertSuccessful();
    }

    public function testStore()
    {
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

        $response->assertStatus(201)
                 ->assertHeaderMissing('Link');
    }

    public function testEdit()
    {
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $response = $this->actingAs($user1)
                         ->get(route('post.edit', $post));

        $response->assertStatus(200)
                 ->assertViewHas('post');
    }

    public function testEditData()
    {
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $response = $this->actingAs($user1)
                         ->get('post/edit/'.$post->id);

        $response->assertSuccessful()
                 ->assertJsonStructure([
                     'id',
                     'title',
                     'message',
                 ]);
    }

    public function testEditDataAnother()
    {
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $user2 = factory(User::class)->create();

        $response = $this->actingAs($user2)
                         ->get('post/edit/'.$post->id);

        $response->assertStatus(403);
    }

    public function testUpdate()
    {
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $response = $this->actingAs($user1)
                         ->put(route('post.update', $post), [
                             'title'   => 'test',
                             'message' => 'test',
                         ]);

        $this->assertDatabaseHas('posts', [
            'id'      => $post->id,
            'user_id' => $user1->id,
            'title'   => 'test',
            'message' => 'test',
        ]);

        $response->assertSuccessful();
    }

    public function testUpdateAnother()
    {
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $user2 = factory(User::class)->create();

        $response = $this->actingAs($user2)
                         ->put(route('post.update', $post), [
                             'title' => 'test',
                         ]);

        $this->assertDatabaseMissing('posts', [
            'id'    => $post->id,
            'title' => 'test',
        ]);

        $response->assertStatus(403);
    }

    public function testDestroyConfirm()
    {
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $response = $this->actingAs($user1)
                         ->get(route('post.confirm', $post));

        $response->assertViewHas('post', $post);
    }

    public function testDestroyConfirmAnother()
    {
        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $user2 = factory(User::class)->create();

        $response = $this->actingAs($user2)
                         ->get(route('post.confirm', $post));

        $response->assertStatus(403);
    }

    public function testDestroy()
    {
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

        $user1 = factory(User::class)->create();

        $post = $user1->posts()->create(factory(Post::class)->make()->toArray());

        $user2 = factory(User::class)->create();

        $response = $this->actingAs($user2)
                         ->post(route('post.report', $post), [
                             'reason' => 'test',
                         ]);

        Notification::assertSentTo(
            new AnonymousNotifiable(), PostReportNotification::class,
            function ($notification, $channels) use ($post) {
                return $notification->post->id === $post->id;
            }
        );
    }
}
