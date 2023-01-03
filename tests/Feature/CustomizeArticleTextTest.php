<?php

namespace Tests\Feature;

use App\Libraries\CustomTagReplacer\CustomTagReplacer;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomizeArticleTextTest extends TestCase
{
    use RefreshDatabase;

    private $testString = '[b]string[/b][i]string[/i][a="article"]string[/a]';

    public function test_customize()
    {
        $article = Article::factory()
            ->hasSections(['body' => $this->testString])
            ->create(['foreword' => $this->testString]);

        $replacer = new CustomTagReplacer($this->testString);
        $customizedString = $replacer->replace();

        $this->assertEquals($article->foreword, $customizedString);
        $this->assertEquals($article->sections->first()->body, $customizedString);
    }

    public function test_customize_dont_work_in_header_fields()
    {
        $article = Article::factory()
            ->hasSections(['header' => $this->testString])
            ->create(['header' => $this->testString]);

        $this->assertEquals($article->header, $this->testString);
        $this->assertEquals($article->sections->first()->header, $this->testString);
    }

    public function test_cant_put_dangerous_html()
    {
        $dangerousHtml = '<script>alert("dangerous")</script>';

        $article = Article::factory()
            ->hasSections(['body' => $dangerousHtml])
            ->create(['foreword' => $dangerousHtml]);

        $safeText = htmlspecialchars($dangerousHtml);

        $this->assertEquals($article->foreword, $safeText);
        $this->assertEquals($article->sections->first()->body, $safeText);
    }
}
