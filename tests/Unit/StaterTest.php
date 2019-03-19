<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Starter;
use App\Model\User;

//TODO:後で削除
class StaterTest extends TestCase
{
    use RefreshDatabase;

    public function testCan()
    {
        $users = factory(User::class, 100)->create();

        $this->assertTrue(Starter::can(config('artisans.starter.step1')));
        $this->assertTrue(Starter::can(config('artisans.starter.step2')));
        $this->assertFalse(Starter::can(config('artisans.starter.step3')));
        $this->assertFalse(Starter::can(config('artisans.starter.step4')));
    }

    public function testExpired()
    {
        $users = factory(User::class, 100)->create();

        $this->assertEquals(20, Starter::expired());
    }
}
