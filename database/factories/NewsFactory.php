<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $author = User::inRandomOrder()->first();

    return [
        'title' => $this->faker->sentence,
        'description' => $this->faker->paragraph,
        'image' => 'news_images/VkZnQxhoLAVR0IuWIphXDlAkRqN8UZ4wR03vxEJA.png',
        'author' => $author->username,
        'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
    ];
    }
}
