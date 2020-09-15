<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'             => $this->faker->unique()->randomNumber,
            'name'           => $this->faker->unique()->userName,
            'avatar'         => $this->faker->imageUrl(240, 240),
            'title'          => $this->faker->sentence,
            'message'        => $this->faker->text,
            'remember_token' => Str::random(10),
        ];
    }
}
