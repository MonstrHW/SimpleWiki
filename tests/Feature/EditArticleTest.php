<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_successful_response()
    {
        $article = Article::factory()->create();

        $response = $this->get(route('edit', $article));
        $response->assertStatus(200);
    }

    public function test_can_edit_article_with_old_slug()
    {
        $article = Article::factory()->create();

        $response = $this->put(route('update', $article), $article->toArray());

        $response->assertSessionDoesntHaveErrors(['slug']);
    }

    public function test_edit()
    {
        $article = Article::factory()
            ->hasSections()
            ->create();

        $editArticleData = Article::factory()->make()->toArray();
        $editSectionData = Section::factory()->make()->toArray();

        $editData = [
            ...$editArticleData,
            'sections' => [
                [...$editSectionData],
            ],
        ];

        $this->put(route('update', $article), $editData);

        $this->assertDatabaseHas('articles', $editArticleData);
        $this->assertDatabaseHas('sections', $editSectionData);
    }
}
