<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles\Article;

class WelcomeController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->latest()
            ->paginate(3);

        return view('welcome', [
            'articles' => $articles,
        ]);
    }
}
