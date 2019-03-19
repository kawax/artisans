<?php

use Illuminate\Database\Seeder;

use App\Model\User;
use App\Model\Tag;
use App\Model\Post;

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
