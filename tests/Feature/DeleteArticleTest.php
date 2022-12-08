<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete()
    {
        $article = Article::factory()
            ->hasSections()
            ->create();

        $section = $article->sections->first();

        $this->delete(route('destroy', $article));

        $this->assertDatabaseMissing('articles', $article->makeHidden('sections')->toArray());
        $this->assertDatabaseMissing('sections', $section->toArray());
    }
}
