<?php

namespace App\Libraries\CustomTagReplacer\BBCodeTags;

use App\Libraries\CustomTagReplacer\CustomTag;

class BoldTag implements CustomTag
{
	public function getPattern(): string
	{
		// [b][/b]
		return '/\[b\](.*?)\[\/b\]/';
	}

	public function getReplacement(array $matches): string
	{
		return "<b>$matches[1]</b>";
	}
}
