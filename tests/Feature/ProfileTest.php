<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Model\User;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function testProfileEdit()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200)
                 ->assertSee('profile-component');
    }

    public function testProfileMe()
    {
        $user = factory(User::class)->create([
            'name' => 'test',
        ]);

        $response = $this->actingAs($user)->get('/profile/me');

        $response->assertStatus(200)
                 ->assertJson([
                     'name' => 'test',
                 ])
                 ->assertJsonStructure([
                     'id',
                     'name',
                     'title',
                     'message',
                     'tags',
                 ]);
    }

    public function testProfileUpdate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->put('/profile', [
            'title'   => 'test',
            'message' => 'test',
            'tags'    => ['test'],
        ]);

        $this->assertDatabaseHas('users', [
            'title'   => 'test',
            'message' => 'test',
        ]);

        $this->assertDatabaseHas('tags', [
            'tag' => 'test',
        ]);

        $response->assertStatus(200);
    }

    public function testProfileDestroy()
    {
        $user = factory(User::class)->create([
            'name' => 'test',
        ]);

        $response = $this->actingAs($user)->delete('/profile/destroy');

        $this->assertDatabaseMissing('users', [
            'name' => 'test',
        ]);

        $response->assertRedirect();
    }
}
