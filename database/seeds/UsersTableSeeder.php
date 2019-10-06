<?php

use App\Model\Post;
use App\Model\Tag;
use App\Model\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 100)->create()
                                 ->each(function (User $user) {
                                     $user->tags()->sync(factory(Tag::class, 3)->create()->pluck('id'));
                                     $user->posts()->save(factory(Post::class)->create([
                                         'user_id' => $user->id,
                                     ]));
                                 });
    }
}
