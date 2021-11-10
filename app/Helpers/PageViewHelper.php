<?php

use App\Page;
use App\PageView;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

if ( ! function_exists('recordPageView')) {

    /**
     * Record page view, creating page record if needed
     *
     * @param string $routeName
     *
     * @return void
     */
    function recordPageView($routeName): void
    {
        $url  = Str::of(route($routeName))->after(env('APP_URL') . '/');
        $page = Page::firstOrNew(['url' => $url]);
        if ( ! $page->title) {
            $response    = Http::get(route('titleQuery', ['routeName' => $routeName]));
            $title       = $response->header('X-Page-Title');
            $page->title = $title;
            $page->save();
        }
        logPageView($page);
    }
}


if ( ! function_exists('logPageView')) {

    /**
     * Write page view relationship entry into database for a given page
     *
     * @param Page $page
     *
     * @return void
     */
    function logPageView(Page $page): void
    {
        $view = new PageView();
        $page->views()->save($view);
    }
}
