<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    private function getFakeImage()
    {
        $imageUrl = fake()->imageUrl();
        $imageContent = file_get_contents($imageUrl);
        $imagePath = 'images/' . uniqid() . '.png';

        $result = Storage::disk('public')->put($imagePath, $imageContent) ? $imagePath : null;

        return $result;
    }

    public function withFakeImage()
    {
        return $this->state(function () {
            $fakeImage = rand(0, 1) ? $this->getFakeImage() : null;

            return [
                'image' => $fakeImage,
            ];
        });
    }

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
