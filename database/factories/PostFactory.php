<?php

namespace Database\Factories;

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

        $published = $this->faker->randomElement([true, false]);
        $published_at = $published ? now() : null;

        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug, // 'The title of the blog post
            'excerpt' => $this->faker->text(200),
            'body' => $this->faker->text(2000),
            'image_path' => $this->faker->imageUrl(),
            'published' => $published,
            'category_id' => $this->faker->numberBetween(1, 5),
            'user_id' => $this->faker->numberBetween(1, 20),
            'published_at' => $published_at,       

        ];
    }
}
