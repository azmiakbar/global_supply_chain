<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NewsService
{
    public function latest(string $keyword): array
    {
        $response = Http::timeout(60)
            ->retry(3, 2000)
            ->acceptJson()
            ->get(
                'https://gnews.io/api/v4/search',
                [
                    'q' => $keyword,
                    'lang' => 'en',
                    'max' => 12,
                    'apikey' => config('services.gnews.api_key'),
                ]
            );

        if (!$response->successful()) {
            return [];
        }

        $articles = [];

        foreach ($response->json()['articles'] ?? [] as $article) {
            $title = $article['title'] ?? '';
            $description = $article['description'] ?? '';

            // 1. Deduplicate inside the batch using title similarity (70% threshold)
            $isDuplicate = false;
            foreach ($articles as $accepted) {
                similar_text(strtolower($title), strtolower($accepted['title']), $percent);
                if ($percent > 70) {
                    $isDuplicate = true;
                    break;
                }
            }

            if ($isDuplicate) {
                continue;
            }

            // 2. Classify based on weighted scoring
            $category = $this->classify($title, $description);

            // 3. Skip unrelated articles (score of 0 on all categories)
            if ($category === null) {
                continue;
            }

            $articles[] = [
                'title' => $title,
                'description' => $description ?: 'No description available.',
                'url' => $article['url'] ?? '#',
                'image' => $article['image']
                    ?? 'https://placehold.co/600x350?text=Global+Supply+Chain',
                'source' => $article['source']['name']
                    ?? 'Unknown Source',
                'publishedAt' => $article['publishedAt'] ?? now(),
                'category' => $category,
            ];
        }

        return $articles;
    }

    /**
     * Classifies a news article based on weighted keyword matching.
     * Returns null if no category matches (meaning the article is unrelated).
     */
    public function classify(string $title, string $description): ?string
    {
        $categories = [
            'Shipping' => ['shipping', 'vessel', 'vessels', 'cargo', 'freight', 'container', 'containers', 'carrier', 'maritime', 'ocean freight', 'shipment', 'shipments', 'fleet'],
            'Trade' => ['trade', 'export', 'exports', 'import', 'imports', 'tariff', 'tariffs', 'customs', 'commerce', 'protectionism', 'bilateral trade', 'trade agreement', 'trade dispute', 'economy', 'economic'],
            'Oil' => ['oil', 'crude', 'petroleum', 'gas', 'lng', 'tanker', 'tankers', 'pipeline', 'refinery', 'fossil fuel', 'energy market'],
            'Port' => ['port', 'ports', 'harbor', 'harbors', 'dock', 'docks', 'terminal', 'terminals', 'berth', 'anchorage'],
            'Logistics' => ['logistics', 'warehouse', 'warehousing', 'transportation', 'distribution', 'supply network', 'supply channel', '3pl', 'fulfillment', 'trucking', 'carrier network'],
            'Supply Chain' => ['supply chain', 'supply chains', 'supplier', 'suppliers', 'procurement', 'sourcing', 'inventory', 'raw material', 'materials sourcing', 'industry', 'industrial', 'manufacturing', 'production', 'factory']
        ];

        // Clean up common port city names to avoid false positive matches on regional news
        $ignoredPhrases = ['port dickson', 'port elizabeth', 'port moresby', 'port harcourt', 'port arthur', 'port louis', 'port vila', 'port sudan', 'port isabel'];
        $titleLower = str_replace($ignoredPhrases, '', strtolower($title));
        $descLower = str_replace($ignoredPhrases, '', strtolower($description));

        $scores = [];

        foreach ($categories as $categoryName => $keywords) {
            $scores[$categoryName] = 0;
            foreach ($keywords as $keyword) {
                $pattern = '/\b' . preg_quote($keyword, '/') . '\b/i';

                // Title matches count with weight 3
                $titleMatches = preg_match_all($pattern, $titleLower);
                if ($titleMatches > 0) {
                    $scores[$categoryName] += $titleMatches * 3;
                }

                // Description matches count with weight 1
                $descMatches = preg_match_all($pattern, $descLower);
                if ($descMatches > 0) {
                    $scores[$categoryName] += $descMatches * 1;
                }
            }
        }

        // Sort descending to find the category with the highest score
        arsort($scores);
        $highestScore = reset($scores);
        $bestCategory = key($scores);

        // If the article scores 0 across all categories, it is deemed unrelated
        if ($highestScore === 0) {
            return null;
        }

        return $bestCategory;
    }
}