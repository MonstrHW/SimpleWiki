<?php

namespace App\Libraries\CustomTagReplacer\BBCodeTags;

use App\Libraries\CustomTagReplacer\CustomTag;

class ArticleTag implements CustomTag
{
	public function getPattern(): string
	{
		// [a=slug]name[/a]
		return '/\[a\=(.*?)\](.*?)\[\/a\]/';
	}

	public function getReplacement(array $matches): string
	{
		$slug = $matches[1];
		$name = $matches[2];

		$url = route('show', $slug);

		return "<a class=\"hover:underline text-[#E15119]\" href=\"$url\">$name</a>";
	}
}
