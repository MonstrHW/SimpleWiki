<?php

namespace App\Services;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;

class ArticleService
{
	private function storeImage($image)
	{
		if (empty($image)) {
			return null;
		}

		return $image->store('images', 'public');
	}

	public function store(ArticleRequest $request)
	{
		$data = $request->validated();

		$data['image'] = $this->storeImage($request->file('image'));

		$article = Article::create($data);
		$article->saveSections($data['sections']);
	}
}
