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
            'is_accepted' => false
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

    public function index()
    {
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(10);
        return view('article.index', compact('articles'));
    }

    public function show(Article $article){
        return view('article.show', compact('article'));
    }

    public function byCategory(Category $category){
        $articles = $category->articles->where('is_accepted', true);
        return view('article.byCategory', compact('articles', 'category'));
    }
}