<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(), // Generate a placeholder image URL (you might need to adjust this based on your needs)
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Random date within the past year
            'updated_at' => now(), // Use the current timestamp for 'updated_at'
        ];
    }
}
