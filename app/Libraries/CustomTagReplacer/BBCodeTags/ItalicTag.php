<?php

namespace App\Libraries\CustomTagReplacer\BBCodeTags;

use App\Libraries\CustomTagReplacer\CustomTag;

class ItalicTag implements CustomTag
{
	public function getPattern(): string
	{
		// [i][/i]
		return '/\[i\](.*?)\[\/i\]/';
	}

	public function getReplacement(array $matches): string
	{
		return "<i>$matches[1]</i>";
	}
}
