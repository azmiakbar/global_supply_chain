<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsAnalysis;

class NewsAnalysisController extends Controller
{
    public function index()
    {
        $news = NewsAnalysis::latest('published_at')->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    public function destroy(NewsAnalysis $newsAnalysis)
    {
        $newsAnalysis->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }
}