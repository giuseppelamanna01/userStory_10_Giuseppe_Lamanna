<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Category;

class CreateArticleForm extends Component
{
    public $title = '';
    public $description = '';
    public $price = '';
    public $category = '';
    public $showSuccess = false;

    public function store()
    {
        $this->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'category' => 'required|exists:categories,id',
        ]);

        Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category,
            'user_id' => Auth::id()
        ]);

        $this->reset(['title', 'description', 'price', 'category']);
        $this->showSuccess = true;
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.create-article-form', compact('categories'));
    }
}