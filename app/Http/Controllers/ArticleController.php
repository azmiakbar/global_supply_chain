<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->latest()->get();

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'category'=>'required',
            'content'=>'required',
            'status'=>'required'
        ]);

        Article::create([
            'user_id'=>Auth::id(),
            'title'=>$request->title,
            'category'=>$request->category,
            'content'=>$request->content,
            'status'=>$request->status,
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success','Article berhasil ditambahkan');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'=>'required|max:255',
            'category'=>'required',
            'content'=>'required',
            'status'=>'required'
        ]);

        $article->update([
            'title'=>$request->title,
            'category'=>$request->category,
            'content'=>$request->content,
            'status'=>$request->status,
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success','Article berhasil diupdate');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success','Article berhasil dihapus');
    }
}