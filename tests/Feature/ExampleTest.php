<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Model\User;
use App\Model\Tag;

use Laravel\Socialite\Facades\Socialite;

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
        $user = factory(User::class)->create([
            'name' => 'test',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200)
                 ->assertViewHas('users')
                 ->assertSee('test');
    }

    public function testUser()
    {
        $user = factory(User::class)->create([
            'name' => 'test',
        ]);

        $response = $this->get('/@test');

        $response->assertStatus(200)
                 ->assertViewHas('user')
                 ->assertSee('test');
    }

    public function testTag()
    {
        $user = factory(User::class)->create()->each(function (User $user) {
            $user->tags()->sync(factory(Tag::class)->create(['tag' => 'test'])->pluck('id'));
        });

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
        Socialite::shouldReceive('driver->user')->andReturn(new class
        {
            public $id       = 'id';
            public $nickname = 'name';
            public $avatar   = 'avatar';
        });

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
