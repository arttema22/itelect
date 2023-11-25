<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View;

class ArticleController extends Controller
{
    public function index(): View\Factory|View\View|Application
    {
        $articles = Article::query()
            ->with(['categories', 'author'])
            ->latest()
            ->paginate(10);

        // return view('articles.index', [
        //     'articles' => $articles,
        // ]);

        return view('wellcome', [
            'articles' => $articles,
        ]);
    }

    public function show(Article $article): View\Factory|View\View|Application
    {
        return view('articles.show', compact('article'));
    }
}
