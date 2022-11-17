<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    public function create()
    {
        return view('article.create');
    }

    public function store(ArticleRequest $request, ArticleService $articleService)
    {
        $articleService->store($request);

        return redirect('/');
    }
}
