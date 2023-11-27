<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles\Article;
use App\Models\Products\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            // ->with(['categories', 'author'])
            ->latest()
            ->paginate(10);

        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
