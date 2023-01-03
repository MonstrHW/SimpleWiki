<?php

namespace App\Libraries\CustomTagReplacer;

use App\Libraries\CustomTagReplacer\BBCodeTags\BoldTag;
use App\Libraries\CustomTagReplacer\BBCodeTags\ItalicTag;
use App\Libraries\CustomTagReplacer\BBCodeTags\ArticleTag;

class CustomTagReplacer
{
	function __construct(
		private string $text = '',
		private array $tags = [
			new ArticleTag(),
			new BoldTag(),
			new ItalicTag(),
		],
	) {
		$this->setText($text);
	}

	public function setText(string $text)
	{
		$this->text = htmlspecialchars($text);
	}

	public function replace(): string
	{
		foreach ($this->tags as $tag) {
			if ($tag instanceof CustomTag) {
				$this->text = preg_replace_callback($tag->getPattern(), function ($matches) use ($tag) {
					return $tag->getReplacement($matches);
				}, $this->text);
			}
		}

		return $this->text;
	}
}
