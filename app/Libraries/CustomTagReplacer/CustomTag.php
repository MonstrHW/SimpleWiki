<?php

namespace App\Libraries\CustomTagReplacer;

interface CustomTag
{
	public function getPattern(): string;
	public function getReplacement(array $matches): string;
}
