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
        $headerSize = rand(5, config('size.article.header'));
        $forewordSize = rand(5, config('size.article.foreword'));

        $header = fake()->text($headerSize);
        $header = str_replace('.', '', $header);

        return [
            'slug' => Str::slug($header),
            'header' => $header,
            'foreword' => fake()->text($forewordSize),
        ];
    }
}
