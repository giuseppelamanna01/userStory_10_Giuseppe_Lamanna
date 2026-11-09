<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller implements HasMiddleware
{
    public function create(){
        return view('article.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'category' => 'required|exists:categories,id',
        ]);

        Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category,
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Articolo creato correttamente');
    }

    public static function middleware(): array
    {
        return [
            new Middleware('auth', only: ['create', 'store']),
        ];
    }
}