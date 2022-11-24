<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Str;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_successful_response()
    {
        $response = $this->get(route('create'));
        $response->assertStatus(200);
    }

    public function test_header_and_foreword_field_required()
    {
        $inputData = [
            'header' => null,
            'foreword' => null,
        ];

        $response = $this->post(route('store'), $inputData);
        $response->assertSessionHasErrors(['header', 'foreword']);
    }

    public function test_create()
    {
        $article = [
            'header' => 'header',
            'foreword' => 'foreword',
            'sections' => [
                [
                    'header' => 'header',
                    'body' => 'body',
                ],
            ],
        ];

        $this->post(route('store'), $article);

        $this->assertDatabaseHas('articles', ['header' => 'header']);
        $this->assertDatabaseHas('sections', ['header' => 'header']);
    }

    public function test_fail_to_create_articles_with_same_slugs()
    {
        $article = Article::factory()->create();

        $response = $this->post(route('store'), ['header' => $article->header]);
        $response->assertSessionHasErrors(['slug']);
    }

    public function test_fail_to_create_sections_with_same_slugs()
    {
        $section = Section::factory()->make();

        $response = $this->post(
            route('store'),
            [
                'sections' => [
                    ['header' => $section->header],
                    ['header' => $section->header],
                ]
            ]
        );
        $response->assertSessionHasErrors(['sections.0.slug', 'sections.1.slug']);
    }
}
