<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    /*body Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $headerSize = rand(5, config('size.section.header'));
        $bodySize = rand(5, config('size.section.body'));

        $header = fake()->text($headerSize);

        return [
            'slug' => Str::slug($header),
            'header' => $header,
            'body' => fake()->text($bodySize),
        ];
    }
}
