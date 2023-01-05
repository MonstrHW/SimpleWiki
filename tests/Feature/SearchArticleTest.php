<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_search()
    {
        $article = Article::factory()->create();

        $response = $this->getJson(route('search', $article->header));

        $response->assertExactJson([[
            'url' => route('show', $article),
            'header' => $article->header,
        ]]);
    }
}
