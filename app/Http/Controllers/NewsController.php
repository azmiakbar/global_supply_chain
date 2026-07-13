<?php

namespace App\Http\Controllers;

use App\Services\NewsService;

class NewsController extends Controller
{
    protected NewsService $newsService;

    public function __construct(
        NewsService $newsService
    ){
        $this->newsService = $newsService;
    }

    public function index()
    {
        $countries = [

            'Indonesia',
            'Japan',
            'China',
            'Brazil',
            'Singapore',
            'India',
            'United States'

        ];

        $allNews = [];

        foreach($countries as $country){

            $news = $this->newsService->latest($country);

            foreach($news as $article){

                $article['country']=$country;

                $allNews[]=$article;

            }

        }

        return view(
            'news.index',
            compact('allNews')
        );

    }

}