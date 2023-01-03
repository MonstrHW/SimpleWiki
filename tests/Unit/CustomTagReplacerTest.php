<?php

namespace Tests\Unit;

use App\Libraries\CustomTagReplacer\BBCodeTags\ArticleTag;
use App\Libraries\CustomTagReplacer\BBCodeTags\BoldTag;
use App\Libraries\CustomTagReplacer\BBCodeTags\ItalicTag;
use App\Libraries\CustomTagReplacer\CustomTagReplacer;
use Closure;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CustomTagReplacerTest extends TestCase
{
    private CustomTagReplacer $replacer;

    private function createMockTag(string $tagClass, Closure $replacementStub): MockObject
    {
        $tagMock = $this->getMockBuilder($tagClass)
            ->onlyMethods(['getReplacement'])
            ->getMock();

        $tagMock->method('getReplacement')->will($this->returnCallback($replacementStub));

        return $tagMock;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $mockTags[] = $this->createMockTag(
            ArticleTag::class,
            fn (array $matches): string => "<a href=\"$matches[1]\">$matches[2]</a>"
        );
        $mockTags[] = $this->createMockTag(
            BoldTag::class,
            fn (array $matches): string => "<b>$matches[1]</b>"
        );
        $mockTags[] = $this->createMockTag(
            ItalicTag::class,
            fn (array $matches): string => "<i>$matches[1]</i>"
        );

        $this->replacer = new CustomTagReplacer(tags: $mockTags);
    }

    private function replaceTest(string $testString, string $expected)
    {
        $this->replacer->setText($testString);
        $result = $this->replacer->replace();

        $this->assertEquals($expected, $result);
    }

    public function test_replace()
    {
        $this->replaceTest(
            '[b]string[/b][i]string[/i][a=article]string[/a]',
            '<b>string</b><i>string</i><a href="article">string</a>'
        );
    }

    public function test_nesting_replace()
    {
        $this->replaceTest(
            '[b][i][a=article]string[/a][/i][/b]',
            '<b><i><a href="article">string</a></i></b>'
        );
    }

    public function test_non_greedy_replace()
    {
        $this->replaceTest(
            '[b]string[/b][i]string[/i][a=article]string[/a][b]string[/b][i]string[/i][a=article]string[/a]',
            '<b>string</b><i>string</i><a href="article">string</a><b>string</b><i>string</i><a href="article">string</a>'
        );
    }
}
