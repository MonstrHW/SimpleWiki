<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_slug_route_work()
    {
        $article = Article::factory()->create();

        $response = $this->get(route('show', ['article' => $article->slug]));
        $response->assertStatus(200);
    }
}
