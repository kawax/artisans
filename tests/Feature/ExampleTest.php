<?php

namespace Tests\Feature;

use App\Model\Tag;
use App\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $user = factory(User::class)->create(
            [
                'name' => 'test',
            ]
        );

        $response = $this->get('/');

        $response->assertStatus(200)
                 ->assertViewHas('users')
                 ->assertSee('test')
                 ->assertHeader('Link');
    }

    public function testUser()
    {
        $user = factory(User::class)->create(
            [
                'name'    => 'test',
                'title'   => '<script>title</script>',
                'message' => '<script>message</script>',
            ]
        );

        $response = $this->get('/@test');

        $response->assertStatus(200)
                 ->assertViewHas('user')
                 ->assertSee('test')
                 ->assertSee('&lt;script&gt;', false)
                 ->assertDontSee('<script>', false);
    }

    public function testUserNotFound()
    {
        $response = $this->get('/@test');

        $response->assertStatus(404);
    }

    public function testTag()
    {
        $user = factory(User::class)->create()->each(
            function (User $user) {
                $user->tags()->sync(factory(Tag::class)->create(['tag' => 'test'])->pluck('id'));
            }
        );

        $response = $this->get('/tag/test');

        $response->assertStatus(200)
                 ->assertViewHas('users')
                 ->assertViewHas('tag')
                 ->assertSee('test');
    }

    public function testLogin()
    {
        $response = $this->get('/login');

        $response->assertRedirect();
    }

    public function testLogout()
    {
        $response = $this->get('/logout');

        $response->assertRedirect();
        $this->assertGuest();
    }

    public function testCallback()
    {
        $user = (new \Laravel\Socialite\Two\User())->map(
            [
                'id'       => 'id',
                'nickname' => 'name',
                'avatar'   => 'avatar',
            ]
        );

        Socialite::shouldReceive('driver->user')->andReturn($user);

        $response = $this->get('/callback?code=test');

        $response->assertRedirect(route('user', 'name'));
        $this->assertAuthenticated();
    }

    public function testCallbackFail()
    {
        $response = $this->get('/callback');

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
