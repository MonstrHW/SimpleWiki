<?php

namespace Tests\Feature;

use Tests\TestCase;

class IndexArticleTest extends TestCase
{
    public function test_returns_a_successful_response()
    {
        $response = $this->get(route('index'));
        $response->assertStatus(200);
    }
}
