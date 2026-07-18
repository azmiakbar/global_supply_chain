<?php

namespace App\Http\Controllers;

use App\Models\NewsAnalysis;
use App\Services\NewsService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    protected NewsService $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index()
    {
        // Cache the GNews API fetch for 15 minutes to preserve API key quota
        Cache::remember('latest_gnews_fetch', 15 * 60, function () {
            $query = '("supply chain" OR logistics OR shipping OR port OR trade OR oil OR freight OR cargo)';
            $news = $this->newsService->latest($query);

            foreach ($news as $article) {
                $title = $article['title'] ?? '';
                $description = $article['description'] ?? '';
                $url = $article['url'] ?? '';

                if (empty($url)) {
                    continue;
                }

                $sentiment = $this->detectSentiment($title);

                NewsAnalysis::updateOrCreate(
                    [
                        'url' => $url
                    ],
                    [
                        'country' => 'Global',
                        'source' => $article['source'] ?? 'Unknown Source',
                        'title' => $title,
                        'description' => $description,
                        'image' => $article['image']
                            ?? 'https://placehold.co/600x350?text=Global+Supply+Chain',
                        'published_at' => isset($article['publishedAt'])
                            ? Carbon::parse($article['publishedAt'])->format('Y-m-d H:i:s')
                            : now(),
                        'sentiment' => $sentiment,
                        'category' => $article['category'] ?? 'Supply Chain',
                    ]
                );
            }
            return true;
        });

        // Run a one-time backfill to categorize older articles in the DB
        $unclassified = NewsAnalysis::where('category', 'Supply Chain')
            ->orWhereNull('category')
            ->get();

        if ($unclassified->isNotEmpty()) {
            foreach ($unclassified as $item) {
                $cat = $this->newsService->classify($item->title, $item->description ?? '');
                if ($cat) {
                    $item->update(['category' => $cat]);
                }
            }
        }

        $allNews = NewsAnalysis::orderByDesc('published_at')
            ->paginate(12);

        return view('news.index', compact('allNews'));
    }

    private function detectSentiment(string $title): string
    {
        $title = strtolower($title);

        $positive = [
            'growth',
            'recover',
            'increase',
            'improve',
            'success',
            'expand',
            'stable',
            'profit',
            'boost',
            'rise',
            'record'
        ];

        $negative = [
            'war',
            'delay',
            'crisis',
            'strike',
            'storm',
            'accident',
            'decline',
            'drop',
            'loss',
            'conflict',
            'shutdown',
            'disruption'
        ];

        foreach ($positive as $word) {
            if (str_contains($title, $word)) {
                return 'Positif';
            }
        }

        foreach ($negative as $word) {
            if (str_contains($title, $word)) {
                return 'Negatif';
            }
        }

        return 'Netral';
    }

    public function apiIndex()
    {
        $news = NewsAnalysis::orderByDesc('published_at')->get();
        return response()->json($news);
    }
}