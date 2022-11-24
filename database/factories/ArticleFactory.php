<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $header = fake()->words(3, true);

        return [
            'slug' => Str::slug($header),
            'header' => $header,
            'foreword' => fake()->paragraphs(5, true),
        ];
    }
}
