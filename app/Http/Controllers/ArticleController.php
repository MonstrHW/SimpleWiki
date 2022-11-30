<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    public function create()
    {
        return $this->edit(new Article());
    }

    public function store(ArticleRequest $request, ArticleService $articleService)
    {
        $articleService->store($request);

        return redirect('/');
    }

    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('article.create-edit', compact('article'));
    }

    public function update(ArticleRequest $request, Article $article, ArticleService $articleService)
    {
        $articleService->update($request, $article);

        return redirect(route('show', $article));
    }
}
