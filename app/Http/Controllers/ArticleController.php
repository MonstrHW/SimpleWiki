<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    public function index()
    {
        $randomArticles = Article::inRandomOrder()->limit(8)->get();

        return view('article.index', compact('randomArticles'));
    }

    public function create()
    {
        return $this->edit(new Article());
    }

    public function store(ArticleRequest $request, ArticleService $articleService)
    {
        $article = $articleService->store($request);

        return redirect(route('show', $article));
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

    public function destroy(Article $article, ArticleService $articleService)
    {
        $articleService->destroy($article);

        return redirect(route('index'));
    }

    public function search($search)
    {
        $result = Article::search($search)
            ->get()
            ->take(10)
            ->map(function ($article) {
                return [
                    'url' => route('show', $article),
                    'header' => $article->header,
                ];
            });

        return $result;
    }
}
