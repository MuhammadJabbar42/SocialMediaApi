<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uid = User::query()->count();
        return [
            'userId'=>$this->faker->numberBetween(1,$uid),
            'content' => implode(' ', $this->faker->words), 
            'image'=>'null'
        ];
    }
}
