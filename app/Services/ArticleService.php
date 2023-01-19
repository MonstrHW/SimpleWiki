<?php

namespace App\Services;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleService
{
	private function storeImage($image)
	{
		if (empty($image)) {
			return null;
		}

		return $image->store('images', 'public');
	}

	private function deleteImage($image)
	{
		if (empty($image) || !Storage::disk('public')->exists($image)) {
			return;
		}

		Storage::disk('public')->delete($image);
	}

	public function store(ArticleRequest $request)
	{
		$data = $request->validated();

		$data['image'] = $this->storeImage($request->file('image'));

		$article = Article::create($data);
		$article->saveSections($data['sections']);

		return $article;
	}

	public function update(ArticleRequest $request, Article $article)
	{
		$data = $request->validated();

		if ($request?->delete_image) {
			$this->deleteImage($article->image);

			$data['image'] = null;
		} else if (isset($data['image'])) {
			$this->deleteImage($article->image);

			$data['image'] = $this->storeImage($request->file('image'));
		}

		$article->update($data);

		$article->sections()->delete();
		$article->saveSections($data['sections']);
	}

	public function destroy(Article $article)
	{
		$article->delete();
		$this->deleteImage($article->image);
	}
}
