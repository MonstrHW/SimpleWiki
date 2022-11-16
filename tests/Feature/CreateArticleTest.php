<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
}
